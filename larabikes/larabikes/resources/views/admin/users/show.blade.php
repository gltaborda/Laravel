@extends('layouts.master')

@section('titulo', 'Gestor de usuarios Larabikes')

@section('subtitulo', "Detalles del usuario $user->name")
        
@section('contenido')
	<div class="row">
    	<table class="table table-striped table-bordered my-3">
    		<tr>
    			<td>ID</td>
    			<td>{{ $user->id }}</td>
    		</tr>
    		<tr>
    			<td>Nombre</td>
    			<td>{{ $user->name }}</td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td>{{ $user->email }}</td>
    		</tr>
    		<tr>
    			<td>Fecha de alta</td>
    			<td>{{ $user->created_at }}</td>
    		</tr>
    		<tr>
    			<td>Fecha de verificación</td>
    			<td>{{ $user->email_verified_at }}</td>
    		</tr>
    		<tr>
    			<td>Roles</td>
    			<td>
    				@foreach($user->roles as $rol)
    				<span class="d-inline-block w-50">- {{ $rol->role }}</span>
    				<form class="d-inline-block p-1" method="POST"
    					action="{{ route('admin.user.removeRole') }}">
    					@csrf
    					@method('DELETE')
    					<input type="hidden" name="user_id" value="{{ $user->id }}">
    					<input type="hidden" name="role_id" value="{{ $rol->id }}">
    					<input type="submit" class="form-control" value="Eliminar">
    				</form>   				
    				<br>
    				@endforeach
    			</td>	
    		</tr>
    		
    		<tr>
    			<td>Añadir rol</td>
    			<td>
    				<form method="POST" action="{{ route('admin.user.setRole') }}">
    					@csrf
     					<input type="hidden" name="user_id" value="{{ $user->id }}">
    					<select class="form-control w-50 d-inline" name="role_id">
    					@foreach($user->remainingRoles() as $rol)
    						<option value="{{ $rol->id }}">{{ $rol->role }}</option>
    					@endforeach
    					</select>
    					<input type="submit" class="btn btn-success px-3 ml-1" value="Añadir">
    				</form>
    			</td>
    		</tr>
    		
    	</table>
    	<figure class="col-4">
    		<img class="rounded img-fluid"
    			alt="Imagen del usuario {{ $user->name }}"
    			src="{{ asset('/images/users/default.png') }}">
    		<figcaption class="figure-caption text-center">
    			{{ $user->name }}
    		</figcaption>
    	</figure>
    </div>
    
    <table class="table caption-top table-striped table-bordered my-3">
		<caption>Motos de {{ $user->name }}</caption>
		<tr>
			<th>ID</th>
			<th>Imagen</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Descripción</th>
			<th>Matrícula</th>
			<th>Color</th>
			<th>Operaciones</th>
		</tr>
		@foreach($bikes as $bike)
			<tr>
				<td>{{ $bike->id }}</td>
				<td class="text-start" style="max-width: 70px">
					<img class="rounded" style="max-width: 100%"
        				alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        				title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        				src="{{ $bike->imagen?
            			asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen :
            			asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg' }}">
            	</td>
				<td>{{ $bike->marca }}</td>
				<td>{{ $bike->modelo }}</td>
				<td class="text-break">{{ $bike->descripcion }}</td>
				<td>{{ $bike->matricula? $bike->matricula : '-' }}</td>
				<td class="{{ ($bike->color) == '#000000'? 'text-white' : 'text-dark' }}" 
				style="background-color:{{ $bike->color }}">{{ $bike->color }}</td>
				<td class="text-center">
					<a href="{{ route('bikes.show',$bike->id)}}">
					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
					alt="Ver detalles" title="Ver detalles"></a>
					@can('update', $bike)
        				<a href="{{ route('bikes.edit',$bike->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/update.png') }}"
        				alt="Modificar" title="Modificar"></a>
        			@endcan
        			@can('delete', $bike)	
        				<a href="{{ route('bikes.delete',$bike->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/delete.png') }}"
        				alt="Borrar" title="Borrar"></a>
        			@endcan
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="2">{{ $bikes->links() }}</td>
			<td class="text-end" colspan="6">Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }} motos</td>
		</tr>
	</table>
	
	@if(count($deletedBikes))
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Motos de {{ $user->name }} borradas</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Marca</th>
    			<th>Modelo</th>
    			<th>Matrícula</th>
    			<th colspan="2" class="text-center">Operaciones</th>

    		</tr>
    		@foreach($deletedBikes as $bike)
    			<tr>
    				<td>{{ $bike->id }}</td>
    				<td class="text-start" style="max-width: 70px">
    					<img class="rounded" style="max-width: 100%"
            				alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
            				title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
            				src="{{ $bike->imagen?
                			asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen :
                			asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg' }}">
                	</td>
    				<td>{{ $bike->marca }}</td>
    				<td>{{ $bike->modelo }}</td>
    				<td>{{ $bike->matricula? $bike->matricula : '-' }}</td>
		
    				<td class="text-center">
    					<a href="{{ route('bikes.restore', $bike->id) }}">
    						<button class="btn btn-success">Restaurar</button>
    					</a>
    					
    				</td>
    				
    				<td class="text-center">
    					<a onclick='
    						if(confirm("Estás seguro?"))
    							this.nextElementSibling.submit();''>
    						<button class="btn btn-danger">Eliminar</button>
    					</a>
    					<form method="POST" action="{{ route('bikes.purge') }}">
    						@csrf
    						@method('DELETE')
    						<input name="bike_id" type="hidden" value="{{ $bike->id }}">	
    					</form>
    				</td>
    			</tr>
    		@endforeach
    		
    	</table>
    	@endif
    	
@endsection    		
    		
@section('enlaces')
	@parent
	<a href="{{route('admin.users')}}" class="btn btn-primary my-1 mr-2">Usuarios</a>	
@endsection
