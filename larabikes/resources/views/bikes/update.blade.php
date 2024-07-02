@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', "Actualización de la moto $bike->marca $bike->modelo")
        
@section('contenido') 
	<form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{route('bikes.update',$bike->id)}}">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		
		<div class="form-group row">
			<label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
			<input name="marca" type="text" class="up form-control col-sm-10"
			id="inputMarca" placeholder="Marca" value="{{ $bike->marca }}">
		</div>
		
		<div class="form-group row">
			<label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
			<input name="modelo" type="text" class="up form-control col-sm-10"
			id="inputModelo" placeholder="Modelo" value="{{ $bike->modelo }}">
		</div>
		
		<div class="form-group row">
			<label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
			<input name="kms" type="number" class="up form-control col-sm-10"
			id="inputkms" value="{{ $bike->kms }}">
		</div>
		
		<div class="form-group row">
			<label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
			<input name="precio" type="number" class="up form-control col-sm-4"
			id="inputPrecio" step="1" value="{{ $bike->precio }}">
		</div>
		
		<div class="form-group row">
			<div class="form-check">
    			<input name="matriculada" value="1" class="form-check-input"
    			type="checkbox" {{ $bike->matriculada? "checked" : "" }}>
    			<label class="form-check-label">Matriculada</label>
    		</div>
		</div>
		
		<div class="form-group row my-3">
			<div class="col-sm-9">
        		<label for="inputImagen" class="col-sm-3 col-form-label">
        			{{ $bike->imagen? 'Sustituir' : 'Añadir' }} imagen
        		</label>
        		<input name="imagen" type="file" class="form-control-file" id="inputImagen">
        		@if($bike->imagen)
            	<div class="form-check my-3">
            		<input name="eliminarImagen" type="checkbox"
        				class="form-check-input" id="inputEliminar">
        			<label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
            	</div>
            	<script>
        			inputEliminar.onchange = function(){
        				inputImagen.disabled = this.checked;
        			}
            	</script>
            	@endif
    		</div>
    		
    		<div class="col-sm-3">
        		<label>Imagen actual:</label>
        		<img class="rounded img-thumbnail my-3"
            		alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
            		title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
            		src="{{$bike->imagen?
            			asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
            			asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
    		</div>
    	</div>
    	
		<div class="form-group row">
			<button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
			<button type="reset" class="btn btn-secondary m-2">Reestablecer</button>
		</div>
	</form>
	
	<div class="text-end my-3">
		<div class="btn-group mx-2">
			<a class="mx-2" href="{{ route('bikes.show',$bike->id) }}">
			<img height="40" width="40" src="{{asset('/images/buttons/show.png')}}"
				alt="Detalles" title="Detalles">
			</a>
			<a class="mx-2" href="{{route('bikes.delete',$bike->id)}}">
			<img height="40" width="40" src="{{asset('/images/buttons/delete.png')}}"
				alt="Borrar" title="Borrar">
			</a>
		</div>
	</div>
@endsection
			
@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary my-1 mr-2">Garaje</a>
@endsection		
        
