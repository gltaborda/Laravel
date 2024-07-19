@extends('layouts.master')

@section('titulo', 'Gestor de noticias Laranews')

@section('subtitulo', 'Listado de noticias')
        
@section('contenido')	
	<div class="row">
		<div class="col-6 text-start">{{ $noticias->links() }}</div>
		@auth
		<div class="col-6 text-end">
			<p>Nueva noticia <a href="{{ route('noticias.create') }}"
				class="btn btn-success ml-2">+</a></p>
		</div>
		@endauth
	</div>

		
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Imagen</th>
			<th>Titulo</th>
			<th>Tema</th>
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
				<td>{{ $noticia->titulo }}</td>
				<td>{{ $noticia->tema }}</td>
				<td>{{ $noticia->visitas }}</td>
				<td class="text-center">
					<a href="{{ route('noticias.show',$noticia->id)}}">
					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
					alt="Ver detalles" title="Ver detalles"></a>
				</td>
			</tr>
		@endforeach
		<tr><td colspan="7">Mostrando {{ sizeof($noticias) }} de {{ $noticias->total() }} noticias</td></tr>
	</table>
@endsection    		
