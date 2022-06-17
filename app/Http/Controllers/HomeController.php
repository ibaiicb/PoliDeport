<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\DataTables\UsersDataTable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UsersDataTable $dataTable)
    {
//        dd(Auth::guest());
        if(Auth::check() && (Auth::user()->roles()->first()->name === 'Super Admin' || Auth::user()->roles()->first()->name === 'Admin')) {
            return $dataTable->render('admin.userList');
        }else {
            $products = $this->getProducts();
            $types = $this->getTypes();
            $images = $this->getImages();

            return view('client.home')->with('products', $products)->with('types', $types)->with('images', $images);
        }
    }

    public function getProducts() {
        return Product::all();
    }

    public function getImages() {
        $media=[];
        $products = Product::all();

        foreach ($products as $product) {
            $media[$product->id] = $product->getMedia('product')->last()->getUrl();
        }

        return $media;
    }

    public function getTypes() {
        return Type::all();
    }
}
