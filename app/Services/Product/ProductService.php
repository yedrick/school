<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\CrudService;

class ProductService extends CrudService {
    public function __construct() {
        parent::__construct(Product::class,null);
    }

    public function getTableHeaders():array {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'price' => 'Precio',
            'description' => 'Descripción',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'actions' => 'Acciones'
        ];
    }

    // public function get() {
    //     $products = Product::query();
    //     if (request()->has('date')) {
    //         $products->whereDate('created_at','<=', request('date'));
    //     }
    //     return $products->get();
    // }
}
