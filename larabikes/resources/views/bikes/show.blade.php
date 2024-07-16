@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', "Detalles de la moto $bike->marca $bike->modelo")
        
@section('contenido') 
	<table class="table table-striped table-bordered my-3">
		<tr>
			<td>Dueño</td>
			<td>{{ $bike->user? $bike->user->name : 'Desconocido' }}</td>
		</tr>
	
		<tr>
			<td>ID</td>
			<td>{{ $bike->id }}</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>{{ $bike->marca }}</td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td>{{ $bike->modelo }}</td>
		</tr>
		<tr>
			<td>Descripción</td>
			<td>{{ $bike->descripcion }}</td>
		</tr>
		<tr>
			<td>Precio</td>
			<td>{{ $bike->precio }}</td>
		</tr>
		<tr>
			<td>Kms</td>
			<td>{{ $bike->kms }}</td>
		</tr>
		<tr>
			<td>CV</td>
			<td>{{ $bike->cv }}</td>
		</tr>
		<tr>
			<td>Año</td>
			<td>{{ $bike->year }}</td>
		</tr>
		<tr>
			<td>Matriculada</td>
			<td>{{ $bike->matriculada? 'SI' : 'NO' }}</td>
		</tr>
		@if($bike->matriculada)
        	<tr>
        		<td>Matrícula</td>
        		<td>{{ $bike->matricula? $bike->matricula : '-'  }}</td>
        	</tr>
        @endif
        @if($bike->color)
    		<tr>
    			<td>Color</td>
    			<td style="background-color:{{ $bike->color }}">{{ $bike->color? $bike->color : '-' }}</td>
    		</tr>
    	@endif
		<tr>
			<td>Imagen</td>
			<td class="text-start">
        		<img class="rounded" style="max-width: 400px"
        		alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        		title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        		src="{{$bike->imagen?
        			asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
        			asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
        	</td>
		</tr>
	</table>
	
	
    	<div class="text-end my-3">
    		<div class="btn-group mx-2">
    			@can('update', $bike)
    			<a class="mx-2" href="{{ route('bikes.edit',$bike->id) }}">
    			<img height="40" width="40" src="{{ asset('/images/buttons/update.png') }}"
    				alt="Modificar" title="Modificar">
    			</a>
    			@endcan
    			@can('delete', $bike)
    			<a class="mx-2" href="{{ route('bikes.delete',$bike->id) }}">
    			<img height="40" width="40" src="{{ asset('/images/buttons/delete.png') }}"
    				alt="Borrar" title="Borrar">
    			</a> 
    			@endcan     			     			
    		</div>
    	</div>
@endsection    		
    		
@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary my-1 mr-2">Garaje</a>	
@endsection