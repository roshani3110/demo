<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Imports\ProductsImport;
use Excel;
use App\Product;

class ProductsController extends Controller
{
    public function uploadFile (Request $request) {
        Log::info('upload file');
        $path = $request->file('file')->storeAs('public/upload', time() . '.xlsx');
        $filename = $request->file->getClientOriginalName();
        Excel::import(new ProductsImport, $path);

        return back()
            ->with('success','You have successfully upload file.');
    }

    public function listProducts () {
        $products = Product::all();
        return view('welcome', ['products' => $products]);
    }
}
