@extends('layouts.master')

@section('titulo', 'Bienvenido a Larabikes')

@section('subtitulo')
@endsection

@section('contenido')
<!-- PARTE CENTRAL -->
	<figure class="row mt-2 mb-2 col-10 offset-1">
		<img class="d-block w-100"
			alt="Moto de Kaneda en Akira"
			src="{{asset('images/bikes/bike0.png')}}">
	</figure>
	<p>Implementación de un <b>CRUD</b> de motos.</p>
@endsection

@section('enlaces')
@show



