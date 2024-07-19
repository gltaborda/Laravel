@extends('layouts.master')

@section('titulo', 'Gestor de noticias Laranews')

@section('subtitulo', 'Nueva noticia')

@section('contenido')
    <form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{route('noticias.store')}}">
    	@csrf
    	<div class="form-group row">
    		<label for="inputTitulo" class="col-sm-2 col-form-label">Titulo</label>
    		<input name="titulo" type="text" class="up form-control col-sm-10"
    		id="inputTitulo" placeholder="Titulo" value="{{ old('titulo') }}">
    	</div>
    	
    	
    	<div class="form-group row">
    		<label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
    		<textarea name="texto" type="text" class="up form-control col-sm-10"
    		id="inputTexto" placeholder="Texto" value="{{ old('texto') }}"></textarea>
    	</div>
 	
 		<div class="form-group row m-2">
 			<div class="form-group col ">
        		<label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
        		<input name="imagen" type="file" class="form-control-file col-sm-10" id="inputImagen">
        	</div>
 			<div class="form-group col text-end m-2">
 				<label for="inputTema" class="col-sm-2 m-2 col-form-label">Tema</label>
        		<input name="tema" type="hidden" value="{{ old('tema') }}">
        		<select class="form-control w-50 d-inline" name="role_id">
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
    	
    	<div class="form-group row">
    		<button type="submit" class="btn btn-success m-1">Guardar</button>
    		<button type="reset" class="btn btn-secondary m-1">Borrar</button>
    	</div>
    	
    </form>
@endsection

@section('enlaces')
	@parent
	<a href="{{ route('noticias.index') }}" class="btn btn-primary my-1 mr-2">Lista de noticias</a>
@endsection

