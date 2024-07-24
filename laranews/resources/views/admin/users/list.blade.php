@extends('layouts.master')

@section('titulo', 'Gestor de usuarios Laranews')

@section('subtitulo', 'Listado de usuarios')
        
@section('contenido')	
	<div class="row p-3">
    	<form method="GET" class="col-5" action="{{ route('admin.users.search') }}">
    		<div class="row">
        		<input name="name" type="text" class="col form-control m-1 my-2" 
        			placeholder="Nombre" maxlength="16" value="{{ $name ?? '' }}">
        		
        		<input name="email" type="text" class="col form-control m-1 my-2" 
        			placeholder="email" maxlength="16" value="{{ $email ?? '' }}">
        
                <button type="submit" class="col btn btn-primary btn-sm m-1 my-2">Buscar</button>
                <a href="{{ route('admin.users') }}" class="col btn btn-secondary btn-sm m-1" role="button">Quitar filtro</a>	
    		</div>		
    	</form>
	</div>
	
	<div class="col-6 text-start">{{ $users->links() }}</div>
		
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Fecha de alta</th>
			<th>Roles</th>
			<th>Operaciones</th>
		</tr>
		@foreach($users as $u)
			<tr>
				<td><b>{{ $u->id }}</b></td>
				<td><a class="link-dark link-underline link-underline-opacity-0" 
					href="{{ route('admin.user.show',$u->id) }}">
					<b>{{ $u->name }}</b></a>
				</td>
				<td><a class="link-dark"
					href="mailto:{{ $u->email }}">
					{{ $u->email }}</a>
				</td>
				<td>{{ $u->created_at }}</td>
				<td class="small text-start">
					@foreach($u->roles as $rol)
					- {{ $rol->role }}<br>
					@endforeach
				</td>	
				<td class="text-center"><a href="{{ route('admin.user.show',$u->id)}}">
					<img height="30" width="30" src="{{ asset('/images/buttons/details.png') }}"
					alt="Ver detalles" title="Ver detalles"></a>
				</td>
			</tr>
			
		@endforeach
		<tr><td colspan="6">Mostrando {{ sizeof($users) }} de {{ $users->total() }} usuarios</td></tr>
	</table>
@endsection    		
