<?php
Route::group(['middleware' => ['auths','administrador']], function (){
 Route::resource('gestion/usuario', 'DigitalsiteSaaS\Usuario\Http\UsuarioController');
 Route::get('gestion/usuario/editar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@editar');
 Route::post('gestion/usuario/actualizar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@actualizar');
 Route::post('gestion/usuario/crear', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@crear');
 Route::get('gestion/usuario/eliminar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@eliminar');
 Route::get('gestion/crear-usuario', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@crearusuario');
});

Route::group(['middleware' => ['web']], function () {
  Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
});