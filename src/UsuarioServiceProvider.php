<?php

namespace DigitalsiteSaaS\Usuario;

use Illuminate\Support\ServiceProvider;

class UsuarioServiceProvider extends ServiceProvider{
	
 public function register(){
 $this->app->bind('usuario', function($app){
 return new Usuario;
 });
 }

 public function boot(){
 require __DIR__ . '/Http/routes.php';
 $this->loadViewsFrom(__DIR__ . '/../views', 'usuario');
 $this->publishes([
 __DIR__ . '/migrations/2015_07_25_000000_create_usuario_table.php' => base_path('database/migrations/2015_07_25_000000_create_usuario_table.php'),
 ]);
 }

}