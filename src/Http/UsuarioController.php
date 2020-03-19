<?php

namespace DigitalsiteSaaS\Usuario\Http;
use DigitalsiteSaaS\Usuario\Usuario;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use GuzzleHttp\Client;


class UsuarioController extends Controller{
	
public function __construct(){
 $this->middleware('auth');
}

public function index() {
 $users = Usuario::all();
 return view('usuario::usuarios')->with('users',$users);
}

public function crear(){
 $price = DB::table('users')->max('id');
 $suma = $price + 1;
 $path = public_path() . '/fichaimg/clientes/'.$suma;
 File::makeDirectory($path, 0777, true);
 $password = Input::get('password');
 $remember = Input::get('_token');
 $user = new Usuario;
 $user->name = Input::get('name');
 $user->last_name = Input::get('last_name');
 $user->email = Input::get('email');
 $user->address = Input::get('address');
 $user->phone = Input::get('phone');;
 $user->rol_id = Input::get('level');
 $user->remember_token = Input::get('_token');
 $user->password = Hash::make($password);
 $user->remember_token = Hash::make($remember);
 $user->save();
 return Redirect('gestion/usuario')->with('status', 'ok_create');
}  

public function eliminar($id) {
 $user = Usuario::find($id);
 $user->delete();
 return Redirect('gestion/usuario')->with('status', 'ok_delete');
}

public function editar($id){
 $usuario = Usuario::find($id);
 return view('usuario::editar-usuario')->with('usuario', $usuario);
}

public function actualizar($id){
 $input = Input::all();
 $user = Usuario::find($id);
 $user->name = Input::get('name');
 $user->last_name = Input::get('last_name');
 $user->email = Input::get('email');
 $user->address = Input::get('address');
 $user->phone = Input::get('phone');
 $user->rol_id = Input::get('level');
 $user->save();
 return Redirect('gestion/usuario')->with('status', 'ok_update');
}

}