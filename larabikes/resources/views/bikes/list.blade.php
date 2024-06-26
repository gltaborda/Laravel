@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', 'Listado de motos')
        
@section('contenido')	
	<div class="row">
		<div class="col-6 text-start">{{ $bikes->links() }}</div>
		<div class="col-6 text-end">
			<p>Nueva moto <a href="{{route('bikes.create')}}"
				class="btn btn-success ml-2">+</a></p>
		</div>
	</div>
	
	<form method="GET" class="col-6 row" action="{{route('bikes.search')}}">
	
		<input name="marca" type="text" class="col form-control mr-2 my-2" 
		placeholder="marca" maxlength="16" value="{{ $marca ?? '' }}">
		
		<input name="modelo" type="text" class="col form-control mr-2 my-2" 
		placeholder="modelo" maxlength="16" value="{{ $modelo ?? '' }}">

        <button type="submit" class="col btn btn-primary btn-sm mr-2 my-2">Buscar</button>	
        	
        <a href="{{ route('bikes.index') }}" class="col btn btn-primary btn-sm mr-2 my-2" role="button">Quitar filtro</a>	
            	
		
		
	</form>
		
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Operaciones</th>
		</tr>
		@foreach($bikes as $bike)
			<tr>
				<td>{{$bike->id}}</td>
				<td>{{$bike->marca}}</td>
				<td>{{$bike->modelo}}</td>
				<td class="text-center">
					<a href="{{route('bikes.show',$bike->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/show.png')}}"
					alt="Ver detalles" title="Ver detalles"></a>
					
					<a href="{{route('bikes.edit',$bike->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/update.png')}}"
					alt="Modificar" title="Modificar"></a>
					
					<a href="{{route('bikes.delete',$bike->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/delete.png')}}"
					alt="Borrar" title="Borrar"></a>
				</td>
			</tr>
		@endforeach
		<tr><td colspan="7">Mostrando {{sizeof($bikes)}} de {{$bikes->total()}} motos</td></tr>
	</table>
@endsection    		
