@extends('layouts.master')

@section('titulo', 'Bienvenido a Larabikes')

@section('subtitulo')
@endsection

@section('contenido')
<!-- PARTE CENTRAL -->
	<figure class="row mt-2 mb-2 col-10 offset-1">
		<img class="d-block w-100"
			alt="Moto de Kaneda en Akira"
			src="{{ asset('images/bikes/bike0.png') }}">
	</figure>
	<p>Implementación de un <b>CRUD</b> de motos.</p>
	
	
	
	<div class="row my-4 bg-light">
		<h5>Estas son las últimas motos subidas a Larabikes </h5>
		@foreach($ultimas->all() as $bike)
    		<figure class="figure col-3 text-center">
    			<img class="rounded img-fluid" src="{{ asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen }}">
    			<p>{{ $bike->marca }} {{ $bike->modelo }}</p>
    		</figure>
		@endforeach
	</div>
	
@endsection

@section('enlaces')
@show



