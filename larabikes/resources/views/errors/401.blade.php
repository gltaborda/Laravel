@extends('layouts.master')

@section('titulo', 'Error 401 - No autorizado')

@section('contenido') 
	<div class="text-center">
		<h4>{{ $exception->getMessage() }}</h4>
  		<img src="{{ asset('/images/memes/unauthorized.gif') }}">
	</div>
	
@endsection