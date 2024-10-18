<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller{

    protected $product;

    public function __construct(ProductService $product) {
        $this->product = $product;
    }

    public function index() {
        try {
            return view('products.index', ['products' => $this->product->get(), 'headers' => $this->product->getTableHeaders()]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function create() {
        try {
            return view('products.create');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function store(StoreProductRequest $request) {
        try {
            $this->product->store($request->all());
            return redirect()->route('products.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function show(Product $product) {
        try {
            return view('products.show', ['product' => $this->product->getById($product->id)]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function edit(Product $product) {
        try{
            return view('products.edit', ['product' => $this->product->getById($product->id)]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function update(UpdateProductRequest $request, Product $product) {
        try {
            $this->product->update($request->all(), $product->id);
            return redirect()->route('products.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function destroy(Product $product) {
        try{
            $this->product->delete($product->id);
            return redirect()->route('products.index')->with('message_success', 'Operación realizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

    public function generateExcel() {
        try {
            return $this->product->generateExcel(['id', 'name', 'price','description']);
        } catch (\ArgumentCountError $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }catch (\Exception $e) {
            return redirect()->route('products.index')->with('message_danger', 'Error en el servidor');
        }
    }

}
