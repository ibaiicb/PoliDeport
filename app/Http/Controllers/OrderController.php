<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request) {
//        return $request;

        $loop = count($request->products);
        $user_id = $request->user;
        $date = date("Y-m-d H:i:s");

        for ($i = 0; $i < $loop; $i++) {
            $product = DB::table('products')
                ->select('products.*')
                ->where('products.name', '=', $request->products[$i]['name'])
                ->get();

            $product[0]->id;

            $amount = $request->products[$i]['quantity'];

            $total_price = ($product[0]->price)*($amount);

            $order = new Order();

            $order->user_id = $user_id;
            $order->product_id = $product[0]->id;;
            $order->quantity = $amount;
            $order->total_price = $total_price;
            $order->date = $date;

            $order->save();

            $newStock = ($product[0]->stock)-($amount);

            $productA = Product::find($product[0]->id);
            $productA->stock = $newStock;
            $productA->save();
        }
    }
}
