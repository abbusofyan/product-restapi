<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;

        $this->middleware('auth');
    }

    public function index()
    {
        return $this->product->getProducts();
    }

    public function find($id) {
        return $this->product->getProductById($id);
    }

    public function add(Request $request) {
        $this->validate($request, [
          'product_name' => 'required|string',
          'category' => 'required|string',
          'price' => 'required|string'
        ]);

        return $this->product->addProduct($request);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
          'product_name' => 'required|string',
          'category' => 'required|string',
          'price' => 'required|string'
        ]);

        return $this->product->updateProduct($request, $id);
    }

    public function delete($id) {
      return $this->product->deleteProduct($id);
    }

}
