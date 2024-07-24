@extends('layouts.master')

@section('titulo', 'Gestor de usuarios Laranews')

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
    
    @if(count($redactadas))
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Mis noticias redactadas</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Titulo</th>
    			<th>Texto</th>
    			<th>Visitas</th>
    			<th>Operaciones</th>
    		</tr>
    		@foreach($redactadas as $noticia)
    			<tr>
    				<td>{{ $noticia->id }}</td>
    				<td class="text-start" style="max-width: 70px">
    					<img class="rounded" style="max-width: 100%"
            				alt="Imagen de la noticia #{{ $noticia->id }}"
            				title="Imagen de la noticia #{{ $noticia->id }}"
            				src="{{ $noticia->imagen?
                			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
                			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
                	</td>
    				<td class="text-break">{{ $noticia->titulo }}</td>
                	<td class="text-break">{{ substr($noticia->texto, 0, 50) }}...</td>
    				<td>{{ $noticia->visitas }}</td>
    				<td class="text-center" style="width: 120px;">
    					<a href="{{ route('noticias.show',$noticia->id)}}">
    					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
    						alt="Ver detalles" title="Ver detalles"></a>
    					<a href="{{ route('noticias.edit',$noticia->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/update.png') }}"
        					alt="Modificar" title="Modificar"></a>
        				<a href="{{ route('noticias.delete',$noticia->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/delete.png') }}"
        					alt="Borrar" title="Borrar"></a>
					</td>
    			</tr>
    		@endforeach
    		<tr>
    			<td colspan="2">{{ $redactadas->links() }}</td>
    			<td class="text-end" colspan="4">Mostrando {{ sizeof($redactadas) }} de {{ $redactadas->total() }} noticias</td>
    		</tr>
    	</table>
    	@endif
    	
    	@if(count($borradas))
        	<table class="table caption-top table-striped table-bordered my-3">
        		<caption>Mis noticias borradas</caption>
        		<tr>
        			<th>ID</th>
        			<th>Imagen</th>
        			<th>Titulo</th>
        			<th>Texto</th>
        			<th>Visitas</th>
        			<th colspan="2" class="text-center">Operaciones</th>
        		</tr>
        		@foreach($borradas as $noticia)
        			<tr>
        				<td>{{ $noticia->id }}</td>
        				<td class="text-start" style="max-width: 70px">
        					<img class="rounded" style="max-width: 100%"
                				alt="Imagen de la noticia #{{ $noticia->id }}"
                				title="Imagen de la noticia #{{ $noticia->id }}"
                				src="{{ $noticia->imagen?
                    			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
                    			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
                    	</td>
						<td class="text-break">{{ $noticia->titulo }}</td>
                    	<td class="text-break">{{ substr($noticia->texto, 0, 50) }}...</td>
        				<td>{{ $noticia->visitas }}</td>
        				<td class="text-center">
        					<a href="{{ route('noticias.restore', $noticia->id) }}">
        						<button class="btn btn-success">Restaurar</button>
        					</a>
        					
        				</td>
        				
        				<td class="text-center">
        					<a onclick='
        						if(confirm("Estás seguro?"))
        							this.nextElementSibling.submit();''>
        						<button class="btn btn-danger">Eliminar</button>
        					</a>
        					<form method="POST" action="{{ route('noticias.purge') }}">
        						@csrf
        						@method('DELETE')
        						<input name="noticia_id" type="hidden" value="{{ $noticia->id }}">	
        					</form>
        				</td>
        			</tr>
        		@endforeach
        		
        	</table>
    	@endif
    	
    	@if(count($comentarios))
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Comentarios</caption>
    		<tr>
    			<th>Usuario</th>
    			<th>Texto</th>
    			<th colspan="2" class="text-center">Operaciones</th>
    		</tr>
    		@foreach($comentarios as $comentario)
    			<tr>
    				<td>{{ $comentario->user->name }}</td>
    				<td>{{ $comentario->texto }}</td>
    				<td class="text-center">
    					<a href="{{ route('noticias.show',$comentario->noticia_id) }}">
    					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
    						alt="Ver detalles" title="Ver detalles"></a>
    				<a onclick='
    						if(confirm("Estás seguro?"))
    							this.nextElementSibling.submit();''>
    						<button class="btn btn-danger">Eliminar</button>
    					</a>
    					<form method="POST" action="{{ route('comentarios.delete') }}">
    						@csrf
    						@method('DELETE')
    						<input name="id" type="hidden" value="{{ $comentario->id }}">	
    					</form>
					</td>
    			</tr>
    		@endforeach
    		<tr>
    			<td colspan="1">{{ $comentarios->links() }}</td>
    			<td class="text-end" colspan="3">Mostrando {{ sizeof($comentarios) }} de {{ $comentarios->total() }} comentarios</td>
    		</tr>
    	</table>
    	@endif
    	
@endsection    		
    		
@section('enlaces')
	@parent
	<a href="{{route('admin.users')}}" class="btn btn-primary my-1 mr-2">Usuarios</a>	
@endsection
