@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-8">
        	<div class="card">
            	<div class="card-header">Perfil de {{ Auth::user()->name }}</div>
           		<div class="card-body">
                    <table class="table">
                		<tr>
                			<td>Nombre</td>
                			<td>{{ Auth::user()->name }}</td>
                		</tr>
                		<tr>
                			<td>E-mail</td>
                			<td>{{ Auth::user()->email }}</td>
                		</tr>
                		<tr>
                			<td>Población</td>
                			<td>{{ Auth::user()->poblacion }}</td>
                		</tr>
                		<tr>
                			<td>Código postal</td>
                			<td>{{ Auth::user()->codigo_postal }}</td>
                		</tr>
                		<tr>
                			<td>Fecha de nacimiento</td>
                			<td>{{ Auth::user()->fecha_nacimiento }}</td>
                		</tr>
                		<tr>
                			<td>Miembro desde</td>
                			<td>{{ Auth::user()->created_at }}</td>
                		</tr>
                		<tr>
                			<td>Verificado</td>
                			<td>{{ Auth::user()->email_verified_at? 'Si' : 'No' }}</td>
                		</tr>
                	</table>   
                </div>
            </div>
    
        </div>
    </div>
    
    	<table class="table caption-top table-striped table-bordered my-3">
    		<caption>Mis motos</caption>
    		<tr>
    			<th>ID</th>
    			<th>Imagen</th>
    			<th>Marca</th>
    			<th>Modelo</th>
    			<th>Descripción</th>
    			<th>Matrícula</th>
    			<th>Color</th>
    			<th>Operaciones</th>
    		</tr>
    		@foreach($bikes as $bike)
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
    				<td class="{{ ($bike->color) == '#000000'? 'text-white' : 'text-dark' }}" 
    				style="background-color:{{ $bike->color }}">{{ $bike->color }}</td>
    				<td class="text-center">
    					<a href="{{ route('bikes.show',$bike->id)}}">
    					<img height="30" width="30" src="{{ asset('/images/buttons/show.png') }}"
    					alt="Ver detalles" title="Ver detalles"></a>
    					@can('update', $bike)
            				<a href="{{ route('bikes.edit',$bike->id) }}">
            				<img height="30" width="30" src="{{ asset('/images/buttons/update.png') }}"
            				alt="Modificar" title="Modificar"></a>
            			@endcan
            			@can('delete', $bike)	
            				<a href="{{ route('bikes.delete',$bike->id) }}">
            				<img height="30" width="30" src="{{ asset('/images/buttons/delete.png') }}"
            				alt="Borrar" title="Borrar"></a>
            			@endcan
    				</td>
    			</tr>
    		@endforeach
    		<tr>
    			<td colspan="2">{{ $bikes->links() }}</td>
    			<td class="text-end" colspan="6">Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }} motos</td>
    		</tr>
    	</table>
    	
    	@if(count($deletedBikes))
        	<table class="table caption-top table-striped table-bordered my-3">
        		<caption>Mis motos borradas</caption>
        		<tr>
        			<th>ID</th>
        			<th>Imagen</th>
        			<th>Marca</th>
        			<th>Modelo</th>
        			<th>Matrícula</th>
        			<th colspan="2" class="text-center">Operaciones</th>

        		</tr>
        		@foreach($deletedBikes as $bike)
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
        				<td>{{ $bike->matricula? $bike->matricula : '-' }}</td>
			
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
        		@endforeach
        		
        	</table>
    	@endif
    	
    	
</div>
@endsection
