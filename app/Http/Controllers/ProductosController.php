<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index(){
        return view('productos');
    }

    /*public function traerProductos(Request $request){
        $productos = Producto::all();
        return response()->json($productos, 200);
    }*/
}
