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
        		<h6><b>{{ $noticia->tema }}</b></h6>
        		<img class="card-img-top border rounded" src="{{ asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen }}">
        		<div class="card-body">
        			<h4 class="card-title text-center"><b>{{ $noticia->titulo }}</b></h4>
        			<p class="card-text">{{ substr($noticia->texto, 0, 40) }}...</p>
        			<a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-primary">Ver más</a>
        		</div>
        	</div>
        @endforeach
        </div>
	
@endsection

@section('enlaces')
@show

