<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VistaAdministrativoController extends Controller
{
    public function index(){
        //Cerrando sesión
        //Auth::logout();
        return "Vista del panel administrativo";
    }
}
