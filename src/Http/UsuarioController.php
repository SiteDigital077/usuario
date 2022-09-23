<?php

namespace DigitalsiteSaaS\Usuario\Http;
use DigitalsiteSaaS\Usuario\Usuario;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;


class UsuarioController extends Controller{

protected $tenantName = null;

 public function __construct(){
  $this->middleware('auth');

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }



 }


public function index() {
 if(!$this->tenantName){
 $users = Usuario::all();
}else{
 $users = \DigitalsiteSaaS\Usuario\Tenant\Usuario::all();
}
$website = app(\Hyn\Tenancy\Environment::class)->website();

 return view('usuario::usuarios')->with('users',$users)->with('website',$website);
}


public function crearusuario() {
 return View('usuario::crear-usuario');
}


public function crear(){
 if(!$this->tenantName){
 $price = Usuario::max('id');
 }else{
 $price = \DigitalsiteSaaS\Usuario\Tenant\Usuario::max('id');
 }
 $suma = $price + 1;
 $path = public_path() . '/fichaimg/clientes/'.$suma;
 File::makeDirectory($path, 0777, true, true);
 $password = Input::get('password');
 $remember = Input::get('_token');
 if(!$this->tenantName){
 $user = new Usuario;
 }else{
 $user = new \DigitalsiteSaaS\Usuario\Tenant\Usuario;	
 }
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
 if(!$this->tenantName){
 $user = Usuario::find($id);
 }else{
 $user = \DigitalsiteSaaS\Usuario\Tenant\Usuario::find($id);
 }
 $user->delete();
 return Redirect('gestion/usuario')->with('status', 'ok_delete');
}

public function editar($id){
 if(!$this->tenantName){
 $usuario = Usuario::find($id);
 }else{
 $usuario = \DigitalsiteSaaS\Usuario\Tenant\Usuario::find($id);
 }
 return view('usuario::editar-usuario')->with('usuario', $usuario);
}

public function actualizar($id){
 $input = Input::all();
 if(!$this->tenantName){
 $user = Usuario::find($id);
 }else{
 $usuario = \DigitalsiteSaaS\Usuario\Tenant\Usuario::find($id);	
 }
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