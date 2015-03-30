@extends('template.main')

@section('content')
	<center><h1><span class="glyphicon glyphicon-user"></span>&nbsp;Ver usuarios</h1></center>
		<div class="table-responsive">
		<table class="table table-stripped">
        <thead>
         <tr>
          <th>Nombre Completo</th>
          <th>Email</th>
          <th>Tipo Usuario</th>
          <th>Editar</th>
          <th>Eliminar</th>
         </tr>
        </thead>
        <tbody>
         @foreach ($users as $user)
          <tr>
           <td>{{ $user->nameComplete }}</td>
           <td>{{ $user->email }}</td>
           <td>{{ $user->tiposUsers->name }}</td>
			<td><a class="btn btn-danger" href="{{Route('edit-users',$user->id)}}"><span class="glyphicon glyphicon-trash"></span></a></td>
			<td><a class="btn btn-warning" href="{{Route('delete-users',$user->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
          </tr>
         @endforeach
        </tbody>
       </table><br>
            @if(Session::has('message'))
               {{ Session::get('message') }}
            @endif
       <br><br>
       <center>
       {{ HTML::link('/', 'Inicio', array('class'=>'btn btn-primary')) }}
       </center>
    </div>
@stop