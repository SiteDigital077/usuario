@extends ('adminsite.layout')
 
 @section('ContenidoSite-01')
  <div class="content-header">
   <ul class="nav-horizontal text-center">
    <li class="active">
     <a href="/gestion/usuario"><i class="gi gi-parents"></i> Usuarios</a>
    </li>
    <li>
     <a href="/gestion/crear-usuario"><i class="fa fa-user-plus"></i> Crear Usuario</a>
    </li>
   </ul>
  </div>

  <div class="container">
   <?php $status=Session::get('status'); ?>
   @if($status=='ok_create')
    <div class="alert alert-success">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <strong>Usuario registrado con éxito</strong> CMS...
    </div>
   @endif

   @if($status=='ok_delete')
    <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <strong>Usuario eliminado con éxito</strong> CMS...
    </div>
   @endif

   @if($status=='ok_update')
    <div class="alert alert-warning">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <strong>Usuario actualizado con éxito</strong> CMS...
    </div>
   @endif
  </div>

  <div class="container">
   <div class="block full">
    
    <div class="block-title">
     <h2><strong>Usuarios</strong> registrados</h2>
    </div>

    <div class="table-responsive">
     <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
      <thead>
       <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">Apellido</th>
        <th>E-mail</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Rol</th>
        <th class="text-center">Acciones</th>
       </tr>
      </thead>
      
      <tbody>
       @if($users)
        @foreach($users as $user)
         <tr>
          <td class="text-center">{{$user->name}}</td>
          <td class="text-center">{{$user->last_name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->address}}</td>
          <td>{{$user->phone}}</td>
          <td>{{$user->rol_id}}</td>
          <td class="text-center">
           <div class="btn-group">
           <a href="<?=URL::to('');?>"><span  id="tip" data-toggle="tooltip" data-placement="left" title="Enviar Mensaje" class="btn btn-warning"><i class="gi gi-envelope sidebar-nav-icon"></i></span></a>
           <a href="<?=URL::to('gestion/usuario/editar/');?>/{{ $user->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Usuario" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
           <a href="<?=URL::to('gestion/usuario/eliminar/');?>/{{$user->id}}" onclick="return confirm('¿Está seguro que desea eliminar el registro?')"><button ="button" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Eliminar Usuario"><i class="hi hi-trash sidebar-nav-icon"></i></button></a>
           </div>
          </td>
         </tr>
        @endforeach
        @else
         <div class="alert alert-danger fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           <strong>NO</strong> Se Encontraron Usuarios Regristrados.</div>
        @endif
      </tbody>
     </table>
    </div>
              
   </div>
  </div>

  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="/adminsite/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>
@stop