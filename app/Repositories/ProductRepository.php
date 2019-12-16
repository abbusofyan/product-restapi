<?php

namespace App\Repositories;

//PANGGIL MODEL USER
use App\Product;
use Illuminate\Http\Request;


class ProductRepository
{
	protected $product;

	public function __construct(Product $product)
	{
        //Instance model User ke dalam property user
	    $this->product = $product;
    }

    //MEMBUAT FUNGSI UNTUK MENGAMBIL DATA YANG TELAH DI PAGINATE
    //DAN DIFUNGSI INI TELAH DIURUTKAN BERDASARKAN CREATED_AT
    //FUNGSI INI MEMINTA PARAMETER JUMLAH DATA YANG AKAN DITAMPILKAN
    public function getProducts() {

        return $this->product->all();

    }

    public function getProductById($id) {

        return $this->product->find($id);

    }

    public function addProduct(Request $request) {

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->save();

        return response()->json([
          'message' => 'Product added'
        ], 201);
    }

    public function updateProduct(Request $request, $id) {
        $product = $this->product->findOrFail($id);
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->save();

        return response()->json([
          'message' => 'Product updated'
        ], 201);
    }

    public function deleteProduct($id) {
        $product = $this->product->findOrFail($id);
        $product->delete();

        return response()->json([
          'message' => 'Product deleted'
        ]);
    }

}
