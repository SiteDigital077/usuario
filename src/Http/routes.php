<?php
Route::group(['middleware' => ['auths','administrador']], function (){
Auth::routes();
 Route::resource('gestion/usuario', 'DigitalsiteSaaS\Usuario\Http\UsuarioController');
 Route::resource('gestion/crear-usuario', 'DigitalsiteSaaS\Usuario\Http\UsuarioController');
 Route::get('gestion/usuario/editar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@editar');
 Route::post('gestion/usuario/actualizar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@actualizar');
 Route::post('gestion/usuario/crear', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@crear');
 Route::get('gestion/usuario/eliminar/{id}', 'DigitalsiteSaaS\Usuario\Http\UsuarioController@eliminar');
 
 Route::get('/gestion/crear-usuario', function(){
 return View::make('usuario::crear-usuario');
 });
});

Route::post('/login', function(App\Http\Requests\AccesoRequest $Request){
 $credentials = Input::only('email', 'password'); 

 if ( ! Auth::attempt($credentials)){
 return Redirect::back()->withMessage('Invalid credentials');
 }

 if (Auth::user()->rol_id == 1){
 return Redirect::to('/gestion/paginas');
 }

 elseif (Auth::user()->rol_id == 2 and count($cart) == 0){
 return Redirect::to('/');
 }

 elseif (Auth::user()->rol_id == 2 and count($cart) >= 1){
 return Redirect::to('/cart/detail');
 }

 elseif (Auth::user()->rol_id == 3){
 return Redirect::to('/gestion/avanza');
 }

 return Redirect::to('/');

});