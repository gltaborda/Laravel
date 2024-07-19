@extends('layouts.master')

@section('titulo', $noticia->tema)

@section('subtitulo', "$noticia->titulo")
        
@section('contenido')
	
	<img class="rounded m-3 text-center" style="max-width: 90%"
		alt="Imagen de la noticia #{{ $noticia->id }}"
		title="Imagen de la noticia #{{ $noticia->id }}"
		src="{{ $noticia->imagen?
		asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
		asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
	<h4 class="text-start m-3">{{ $noticia->texto }}</h4>
	<div class="row">
		<h6 class="col"><b>Autor:</b> {{ $noticia->user? $noticia->user->name : 'Desconocido' }}</h6>
		<h6 class="col text-end">{{ $noticia->created_at }} | Actualizado: {{ $noticia->updated_at }}</h6>
	</div>
@endsection    		
    		
@section('enlaces')
	@parent
	<a href="{{ route('noticias.index') }}" class="btn btn-primary my-1 mr-2">Lista de noticias</a>	
@endsection