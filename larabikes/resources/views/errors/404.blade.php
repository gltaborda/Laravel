@extends('layouts.master')

@section('titulo', 'Error 404')

@section('contenido') 
	<div class="text-center">
		<h4>Página no encontrada, estás perdido?</h4>
		<img src="{{ asset('/images/memes/travolta.gif') }}">
	</div>
@endsection