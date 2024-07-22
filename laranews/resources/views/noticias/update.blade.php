@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', "Actualización de la noticia #$noticia->id")
        
@section('contenido') 
	<form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{ route('noticias.update',$noticia->id) }}">
    	@csrf
    	<input name="_method" type="hidden" value="PUT">
    	
    	<div class="form-group row">
    		<label for="inputTitulo" class="col-sm-2 col-form-label">Titulo</label>
    		<input name="titulo" type="text" class="up form-control col-sm-10"
    		id="inputTitulo" placeholder="Titulo" value="{{ $noticia->titulo }}">
    	</div>
    	
    	
    	<div class="form-group row">
    		<label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
    		<textarea name="texto" type="text" rows="10" class="form-control col-sm-10" style="resize:none;"
    			id="inputTexto" placeholder="Texto" >{{ $noticia->texto }}</textarea>
    	</div>
 	
 		<div class="form-group row m-2">
 			<div class="form-group col m-2">
 				<label for="inputTema" class="col-sm-2 m-2 col-form-label">Tema</label>
        		<select class="form-control w-50 d-inline" name="tema">
        			<option selected >{{ $noticia->tema }}</option>
        			<option value="Arte">Arte</option>
        			<option value="Cultura">Cultura</option>
        			<option value="Deporte">Deporte</option>
        			<option value="Economía">Economía</option>
        			<option value="Política">Política</option>
        			<option value="Salud">Salud</option>
        			<option value="Tecnología">Tecnología</option>
        			<option value="Viajes">Viajes</option>
        		</select>
        	</div>
        	
    	</div>
    	
    	<div class="form-group row my-3">
			<div class="col-sm-9">
        		<label for="inputImagen" class="col-sm-3 col-form-label">
        			{{ $noticia->imagen? 'Sustituir' : 'Añadir' }} imagen
        		</label>
        		<input name="imagen" type="file" class="form-control-file" id="inputImagen">
        		@if($noticia->imagen)
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
            		alt="Imagen de la noticia #{{ $noticia->id }}"
            		title="Imagen de la noticia #{{ $noticia->id }}"
            		src="{{ $noticia->imagen?
            			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
            			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
    		</div>
    	</div>
    	
    	<div class="form-group row">
    		<button type="submit" class="btn btn-success m-1">Guardar</button>
    		<button type="reset" class="btn btn-secondary m-1">Reestablecer</button>
    	</div>
    	
    </form>
@endsection
			
@section('enlaces')
	@parent
	<a href="{{route('noticias.index')}}" class="btn btn-primary my-1 mr-2">Lista de noticias</a>
@endsection		
        
