<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\CrudService;

class CategoryService extends CrudService {

    public function __construct() {
        parent::__construct(Category::class, null);
    }

    public function getTableHeaders(): array {
        return [
            // Definir los headers de la tabla aquí
        ];
    }

    // Puedes descomentar y personalizar este método si lo necesitas
    // public function get() {
    //     $items = Category::query();
    //     if (request()->has('date')) {
    //         $items->whereDate('created_at', '<=', request('date'));
    //     }
    //     return $items->get();
    // }
}
