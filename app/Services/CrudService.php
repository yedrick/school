<?php
namespace App\Services;

use InvalidArgumentException;

class CrudService  {

    protected $model;
    protected $resource;
    protected $perPage;

    public function __construct($model, $resource=null, $perPage = 20) {
        $this->model = $model;
        $this->resource = $resource;
        $this->perPage = $perPage;
    }

    public function get() {
        if($this->resource == null) return $this->model::get();
        return $this->resource::collection($this->model::get());
    }

    public function getPaginated() {
        $currentPage = request()->input('page', 1);
        $paginatedData = $this->model::paginate($this->perPage, ['*'], 'page', $currentPage);
        return $this->resource ? $this->resource::collection($paginatedData) : $paginatedData->items();
    }

    public function getById(int $id) {
        if ($this->resource == null) return $this->model::find($id);
        return new $this->resource($this->model::find($id));
    }

    public function store(array $data) {
        if ($this->resource == null) return $this->model::create($data);
        return new $this->resource($this->model::create($data));
    }

    public function update(array $data, int $id) {
        $model = $this->model::find($id);
        if (!$model) throw new \Exception('Model not found');
        $model->update($data);
        if ($this->resource == null) return $model;
        return new $this->resource($model);
    }

    public function delete(int $id) {
         $this->model::find($id)->delete();
        return null;
    }

    public function generateExcel($titles,$fields=null) {
        $serviceExcel= new ReportExcel();
        if($fields == null) $fields = ['*'];
        $data = $this->model::select($fields)->get()->toArray();
        $tableName = (new $this->model())->getTable();
        $filename=$file=$tableName;
        return $serviceExcel->generateExcel($titles, $data, $filename, $file);
    }

}
