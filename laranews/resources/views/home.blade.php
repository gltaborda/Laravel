@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-8">
        	<div class="card">
            	<div class="card-header">Perfil de {{ Auth::user()->name }}</div>
           		<div class="card-body">
                    <table class="table">
                		<tr>
                			<td>Nombre</td>
                			<td>{{ Auth::user()->name }}</td>
                		</tr>
                		<tr>
                			<td>E-mail</td>
                			<td>{{ Auth::user()->email }}</td>
                		</tr>
                		<tr>
                			<td>Miembro desde</td>
                			<td>{{ Auth::user()->created_at }}</td>
                		</tr>
                		<tr>
                			<td>Verificado</td>
                			<td>{{ Auth::user()->email_verified_at? 'Si' : 'No' }}</td>
                		</tr>
                	</table>   
                </div>
            </div>
    
        </div>
    </div>
    
   		@if(count($publicadas))
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Mis noticias publicadas</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Titulo</th>
    			<th>Texto</th>
    			<th>Visitas</th>
    			<th>Operaciones</th>
    		</tr>
    		@foreach($publicadas as $noticia)
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
    					@can('update', $noticia)
    					<a href="{{ route('noticias.edit',$noticia->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/update.png') }}"
        					alt="Modificar" title="Modificar"></a>
        				@endcan
        				<a href="{{ route('noticias.delete',$noticia->id) }}">
        				<img height="30" width="30" src="{{ asset('/images/buttons/delete.png') }}"
        					alt="Borrar" title="Borrar"></a>
					</td>
    			</tr>
    		@endforeach
    		<tr>
    			<td colspan="2">{{ $publicadas->links() }}</td>
    			<td class="text-end" colspan="4">Mostrando {{ sizeof($publicadas) }} de {{ $publicadas->total() }} noticias</td>
    		</tr>
    	</table>
    	@endif
    	
    	@if(count($redactadas))
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Mis noticias redactadas</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Titulo</th>
    			<th>Texto</th>
    			<th>Estado</th>
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
    				<td class=" {{ $noticia->rejected? 'bg-danger' : 'bg-white' }}"><b>{{ $noticia->rejected? 'Rechazada' : 'Pendiente' }}</b></td>
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
    			<th>Publicado:</th>
    			<th class="text-center">Operaciones</th>
    		</tr>
    		@foreach($comentarios as $comentario)
    			<tr>
    				<td>{{ $comentario->user->name }}</td>
    				<td>{{ $comentario->texto }}</td>
    				<td>{{ $comentario->created_at }}</td>
    				<td class="text-center">
    					<a href="{{ route('noticias.show',$comentario->noticia_id) }}">
    					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
    						alt="Ver detalles" title="Ver detalles"></a>
    				<a onclick='
    						if(confirm("Estás seguro?"))
    							this.nextElementSibling.submit();''>
    						
        					<img height="30" width="30" src="{{ asset('/images/buttons/delete.png') }}"
        						alt="Ver detalles" title="Ver detalles">
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
    	
    	
</div>
@endsection