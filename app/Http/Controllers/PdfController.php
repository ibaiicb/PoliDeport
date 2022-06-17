<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generateUsersPdf() {
        $usersCollection = User::all();

        $users = [];

        for ($i=0; $i<count($usersCollection); $i++) {
            $users[$i] = $usersCollection[$i];
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.usersPdf', ['users' => $users]);
        return $pdf->stream();
    }

    public function generateProductsPdf() {
        $productsCollection = Product::all();

        $products = [];

        for ($i=0; $i<count($productsCollection); $i++) {
            $products[$i] = $productsCollection[$i];
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.productsPdf', ['products' => $products]);
        return $pdf->stream();
    }
}
