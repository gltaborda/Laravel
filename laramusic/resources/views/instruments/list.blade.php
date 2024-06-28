@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', 'Listado de motos')
        
@section('contenido')	
	<div class="row">
		<div class="col-6 text-start">{{ $instruments->links() }}</div>
		<div class="col-6 text-end">
			<p>Nueva moto <a href="{{route('instruments.create')}}"
				class="btn btn-success ml-2"> + </a></p>
		</div>
	</div>
	
	<form method="GET" class="col-6 row" action="{{ route('instruments.search') }}">
	
		<input name="categoria" type="text" class="col form-control mr-2 my-2" 
		placeholder="categoria" maxlength="16" value="{{ $categoria ?? '' }}">
		
		<input name="marca" type="text" class="col form-control mr-2 my-2" 
		placeholder="marca" maxlength="16" value="{{ $marca ?? '' }}">
		
		<input name="modelo" type="text" class="col form-control mr-2 my-2" 
		placeholder="modelo" maxlength="16" value="{{ $modelo ?? '' }}">

        <button type="submit" class="col btn btn-primary btn-sm mr-2 my-2">Buscar</button>	
        	
        <a href="{{ route('instruments.index') }}" class="col btn btn-primary btn-sm mr-2 my-2" role="button">Quitar filtro</a>	
            			
	</form>
		
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Categoria</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Operaciones</th>
		</tr>
		@forelse($instruments as $instrument)
			<tr>
				<td>{{ $instrument->id }}</td>
				<td>{{ $instrument->categoria }} </td>
				<td>{{ $instrument->marca }}</td>
				<td>{{ $instrument->modelo }}</td>
				<td class="text-center">
					<a href="{{route('instruments.show',$instrument->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/show.png')}}"
					alt="Ver detalles" title="Ver detalles"></a>
					
					<a href="{{route('instruments.edit',$instrument->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/update.png')}}"
					alt="Modificar" title="Modificar"></a>
					
					<a href="{{route('instruments.delete',$instrument->id)}}">
					<img height="20" width="20" src="{{asset('/images/buttons/delete.png')}}"
					alt="Borrar" title="Borrar"></a>
				</td>
			</tr>
		@if($loop->last)
			<tr>
				<td colspan="7">Mostrando {{ sizeof($instruments) }} de {{ $instruments->total() }} motos</td>
			</tr>
		@endif
		@empty
			<tr>
				<td colspan="3"> No hay instrumentos que coincidan con la búsqueda </td>
			</tr>
		@endforelse
	</table>
@endsection    		
