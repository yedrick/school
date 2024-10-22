<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller {

    protected $category;

    public function __construct(CategoryService $categoryService) {
        $this->category = $categoryService;
    }

    public function index() {
        try {
            return view('categories.index', ['categories' => $this->category->get(), 'headers' => $this->category->getTableHeaders()]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function create() {
        try {
            return view('categories.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function store(StoreCategoryRequest $request) {
        try {
            $this->category->store($request->all());
            return redirect()->route('categories.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function show(Category $category) {
        try {
            return view('categories.show', ['category' => $this->category->getById($category->id)]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function edit(Category $category) {
        try {
            return view('categories.edit', ['category' => $this->category->getById($category->id)]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category) {
        try {
            $this->category->update($request->all(), $category->id);
            return redirect()->route('categories.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function destroy(Category $category) {
        try {
            $this->category->delete($category->id);
            return redirect()->route('categories.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function generateExcel() {
        try {
            return $this->category->generateExcel(['id', 'name', 'price', 'description']);
        } catch (\ArgumentCountError $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // return redirect()->route('categories.index')->with('message_danger', 'Error en el servidor');
        }
    }
}
