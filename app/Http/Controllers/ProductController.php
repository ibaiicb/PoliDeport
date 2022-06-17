<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable) {
        return $dataTable->render('product.productList');
    }

    public function showCreateProduct() {
        $types = DB::table('types')
            ->select('types.*')
            ->get();

        return view('product.createProduct')->with('types', $types);
    }

    public function store(Request $request) {
//        dd($request);

        $product = new Product();

        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->type_id = $request->type;
        $product->description = $request->description;

        if ($request->file('product-img') !== null) {
            $product->addMedia($request->file('product-img'))->toMediaCollection('product');
        }

        $product->save();

        return redirect()->route('home')->with('success', __('Product created successfully'));
    }

    public function showProduct(Request $request) {
//        dd($request->id);
        $product = Product::find($request->id);

        $types = DB::table('types')
            ->select('types.*')
            ->get();

        return view('product.showProduct')->with('product', $product)->with('types', $types);
    }

    public function showUpdateProduct(Request $request) {
//        dd($request->id);
        $product = Product::find($request->id);

        $types = DB::table('types')
        ->select('types.*')
        ->get();

        return view('product.editProduct')->with('product', $product)->with('types', $types);
    }

    public function update(Request $request) {
//        dd($request);
        $product = Product::find($request->id);

        $product-> name = $request->name;
        $product->stock = $request->stock;
        $product->type_id = $request->type;
        $product->description = $request->description;

        if ($request->file('product-img') !== null) {
            $product->addMedia($request->file('product-img'))->toMediaCollection('product');
        }

        $product->save();

        return redirect('/product/list')->with('success', __('Product successfully modified'));
    }

    public function deleteProduct(Request $request) {
        $product = Product::find($request->id);

        $product->forceDelete();
    }

    public function searchProductByFilter(Request $request) {
        $search = $request->search;
        $price = $request->price;
        $category = $request->category;
        $stock = $request->stock;

        $sql = DB::table('products')
        ->select('products.*');

        if($search !== null) {
            $sql = $sql->where('products.name', 'LIKE', $search.'%');
        }

        if ($category !== null) {
            $sql = $sql->where('products.type_id', '=', $category);
        }

        if ($price !== null) {
            $sql = $sql->whereBetween('products.price', [$price[0], $price[1]]);
        }

        if (!$stock) {
            $sql = $sql->where('products.stock', '>', 0);
        }else {
            $sql = $sql->where('products.stock', '>=', 0);
        }

        return $sql->get();
    }
}
