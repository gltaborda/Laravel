@extends('layouts.master')

@section('titulo', 'Error 429')

@section('contenido') 
	<div class="text-center">
		<h4>{{ $exception->getMessage() }}</h4>
  		<img src="{{ asset('/images/memes/stop.gif') }}">
	</div>
	
@endsection