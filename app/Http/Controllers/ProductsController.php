<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller {
    public function index($id) {
        print_r(\route('products-index', ['id' => $id]));
        return \view('products.index', \compact('id'));
    }

    public function showFromDb() {
        $producuts = DB::select('select * from products');
        dd($producuts);
    }
}
