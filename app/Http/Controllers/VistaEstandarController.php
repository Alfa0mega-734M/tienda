<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VistaEstandarController extends Controller
{
    public function index(){
        //Auth::logout();
        return "Vista de usuario estandar";
    }
}
