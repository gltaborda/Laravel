@extends('layouts.master')

@section('titulo', $noticia->tema)

@section('subtitulo', "$noticia->titulo")
        
@section('contenido')
	
	<div class="text-center">
    	<img class="rounded m-3" style="max-width: 90%"
    		alt="Imagen de la noticia #{{ $noticia->id }}"
    		title="Imagen de la noticia #{{ $noticia->id }}"
    		src="{{ $noticia->imagen?
    			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
    			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
	</div>
	<h4 class="text-start m-3 text-break">{{ $noticia->texto }}</h4>
	<div class="row">
		<h6 class="col"><b>Autor:</b> {{ $noticia->user? $noticia->user->name : 'Desconocido' }}</h6>
		<h6 class="col text-end">{{ $noticia->created_at }} | Actualizado: {{ $noticia->updated_at }}</h6>
	</div>
	
	<div class="text-end my-3">
		<div class="btn-group mx-2">
			@can('update', $noticia)
			<a class="mx-2" href="{{ route('noticias.edit',$noticia->id) }}">
			<img height="40" width="40" src="{{ asset('/images/buttons/update.png') }}"
				alt="Modificar" title="Modificar">
			</a>
			@endcan
			@can('delete', $noticia)
			<a class="mx-2" href="{{ route('noticias.delete',$noticia->id) }}">
			<img height="40" width="40" src="{{ asset('/images/buttons/delete.png') }}"
				alt="Borrar" title="Borrar">
			</a> 
			@endcan     			     			
		</div>
	</div>
	
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
					<a href="{{ route('noticias.show',$noticia->id)}}">
					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
					alt="Ver detalles" title="Ver detalles"></a>
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="1">{{ $comentarios->links() }}</td>
			<td class="text-end" colspan="1">Mostrando {{ sizeof($comentarios) }} de {{ $comentarios->total() }} comentarios</td>
		</tr>
	</table>
	
	<form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{route('comentarios.store')}}">
    	@csrf
    	<div class="form-group row">
    		<label for="inputTexto" class="col-sm-2 col-form-label">Comentario</label>
    		<input type="hidden" name="noticia_id" value="{{ $noticia->id }}">
    		<input name="texto" type="text" class="up form-control col-sm-10"
    		id="inputTexto" placeholder="Escribe tu comentario aquí" value="{{ old('texto') }}">
    	</div>   	
    	
    	<div class="form-group row">
    		<button type="submit" class="btn btn-success m-1">Guardar</button>
    		<button type="reset" class="btn btn-secondary m-1">Borrar</button>
    	</div>
    	
    </form>
	
	
@endsection    		
    		
@section('enlaces')
	@parent
	<a href="{{ route('noticias.index') }}" class="btn btn-primary my-1 mr-2">Lista de noticias</a>	
@endsection