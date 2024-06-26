@extends('layouts.master')

@section('titulo', "Confirmación de borrado de moto $bike->marca $bike->modelo")

@section('subtitulo', 'Borrar moto')
        
@section('contenido')
	<form method="POST" class="my-2 border p-5" action="{{URL::signedRoute('bikes.destroy', $bike->id)}}">
		@csrf
		@method('DELETE')
		<label for="confirmdelete">Seguro que quiere borrar la moto 
			{{ "$bike->marca $bike->modelo" }}?</label>
		<input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-1"
			value="Borrar" id="confirmdelete">
	</form>	
@endsection

@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary my-1 mr-2">Garaje</a>	
    <a href="{{route('bikes.show',$bike->id)}}" class="btn btn-secondary my-1 mr-2">Volver a detalles</a>
@endsection