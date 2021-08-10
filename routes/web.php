<?php


Route::post('/validacion-iniciar-sesion', 'ValidacionIniciarSesionController@iniciar_sesion');
Route::post('/registro', 'ValidacionIniciarSesionController@registro')->name('registro');

Route::get('/', 'ProductosController@index')->name('index');
//Route::get('/traer-productos', 'ProductosController@traerProductos');


Route::get('/detalle_producto', function () {
    return view('detalle_producto');
})->name('detalle');


Route::middleware('guest')->group(function () {
    Route::get('/iniciar-sesion', function () {
        return view('iniciar_sesion');
    })->name('login');

    Route::get('/registro', function () {
        return view('registro');
    })->name('registro');
});

Route::middleware(['auth','administrativo'])->group(function(){
    Route::get('/panel-administrativo', 'VistaAdministrativoController@index');
});


Route::middleware(['auth','estandar'])->group(function(){
    Route::get('/panel-estandar', 'VistaEstandarController@index');
});

Route::get('/cerrar-sesion', function(){
    //Cerrar la sesión
    Auth::logout();
    //Redireccionando a la ruta de Login
    return redirect()->route('login');
});

