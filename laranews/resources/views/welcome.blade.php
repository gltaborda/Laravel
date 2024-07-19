@extends('layouts.master')

@section('titulo', 'Bienvenido a Laranews')

@section('subtitulo')
@endsection

@section('contenido')
<!-- PARTE CENTRAL -->
	
	<h4>Estas son las últimas noticias subidas a Laranews </h4>
	
        <div class="card-group">
        @foreach($ultimas->all() as $noticia)
        	<div class="card" style="width: 15rem;">
        		<img class="card-img-top" src="{{ asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen }}">
        		<div class="card-body">
        			<h5 class="card-title">{{ $noticia->titulo }}</h5>
        			<p class="card-text">{{ $noticia->tema }}</p>
        			<a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-primary">Leer</a>
        		</div>
        	</div>
        @endforeach
        </div>
	
@endsection

@section('enlaces')
@show

