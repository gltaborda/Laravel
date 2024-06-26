@extends('layouts.master')

@section('titulo', 'Error 403')

@section('contenido') 
	<div class="text-center">
		<h4>{{ $exception->getMessage() }}</h4>
  		<img src="{{ asset('/images/memes/forbidden.jpg') }}">
	</div>
	
@endsection