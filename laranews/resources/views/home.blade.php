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
    
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Mis noticias</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Titulo</th>
    			<th>Texto</th>
    			<th>Visitas</th>
    			<th>Operaciones</th>
    		</tr>
    		@foreach($noticias as $noticia)
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
    			<td colspan="2">{{ $noticias->links() }}</td>
    			<td class="text-end" colspan="4">Mostrando {{ sizeof($noticias) }} de {{ $noticias->total() }} noticias</td>
    		</tr>
    	</table>
    	
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Comentarios</caption>
    		<tr>
    			<th>Usuario</th>
    			<th>Texto</th>
    			<th>Operaciones</th>
    		</tr>
    		@foreach($comentarios as $comentario)
    			<tr>
    				<td>{{ $comentario->user->name }}</td>
    				<td>{{ $comentario->texto }}</td>
    				<td class="text-center">
    					<a href="{{ route('noticias.show',$comentario->noticia_id) }}">
    					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
    						alt="Ver detalles" title="Ver detalles"></a>
    				</td>
    			</tr>
    		@endforeach
    		<tr>
    			<td colspan="1">{{ $comentarios->links() }}</td>
    			<td class="text-end" colspan="2">Mostrando {{ sizeof($comentarios) }} de {{ $comentarios->total() }} comentarios</td>
    		</tr>
    	</table>
    	
    	
    	
</div>
@endsection
