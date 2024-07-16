@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', 'Motos borradas')
        
@section('contenido')	
	
	<div class="col-6 text-start">{{ $bikes->links() }}</div>
		
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Imagen</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Descripción</th>
			<th>Matrícula</th>
			<th>Usuario</th>
			<th>Color</th>
			<th colspan="2">Operaciones</th>
		</tr>
		@forelse($bikes as $bike)
			<tr>
				<td>{{ $bike->id }}</td>
				<td class="text-start" style="max-width: 70px">
					<img class="rounded" style="max-width: 100%"
        				alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        				title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
        				src="{{ $bike->imagen?
            			asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen :
            			asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg' }}">
            	</td>
				<td>{{ $bike->marca }}</td>
				<td>{{ $bike->modelo }}</td>
				<td class="text-break">{{ $bike->descripcion }}</td>
				<td>{{ $bike->matricula? $bike->matricula : '-' }}</td>
				<td>{{ $bike->user? $bike->user->name : 'Desconocido' }}</td>
				<td class="{{ ($bike->color) == '#000000'? 'text-white' : 'text-dark' }}" 
				style="background-color:{{ $bike->color }}">{{ $bike->color }}</td>
				<td class="text-center">
					<a href="{{ route('bikes.restore', $bike->id) }}">
						<button class="btn btn-success">Restaurar</button>
					</a>
					
				</td>
				
				<td class="text-center">
					<a onclick='
						if(confirm("Estás seguro?"))
							this.nextElementSibling.submit();''>
						<button class="btn btn-danger">Eliminar</button>
					</a>
					<form method="POST" action="{{ route('bikes.purge') }}">
						@csrf
						@method('DELETE')
						<input name="bike_id" type="hidden" value="{{ $bike->id }}">	
					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="9" class="table-danger">No hay motos borradas</td>
			</tr>
		@endforelse
		<tr><td colspan="10">Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }} motos</td></tr>
	</table>
@endsection    		
