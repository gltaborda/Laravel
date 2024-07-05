@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', 'Nueva moto')

@section('contenido')
    <form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{route('bikes.store')}}">
    	@csrf
    	<div class="form-group row">
        	<div class="form-group col">
        		<label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
        		<input name="marca" type="text" class="up form-control col-sm-10"
        		id="inputMarca" placeholder="Marca" value="{{ old('marca') }}">
        	</div>
        	
        	<div class="form-group col">
        		<label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
        		<input name="modelo" type="text" class="up form-control col-sm-10"
        		id="inputModelo" placeholder="Modelo" value="{{ old('modelo') }}">
        	</div>
        </div>
    	
    	<div class="form-group row">
    		<label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción</label>
    		<input name="descripcion" type="text" class="up form-control col-sm-10"
    		id="inputDescripcion" placeholder="Descripción" value="{{ old('descripcion') }}">
    	</div>
    	
    	<div class="form-group row">
        	<div class="form-group col-sm-2">
        		<label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
        		<input name="kms" type="number" class="up form-control col-sm-10"
        		id="inputKms" value="{{ old('kms') }}">
        	</div>
        	
        	<div class="form-group col-sm-2">
        		<label for="inputCv" class="col-sm-2 col-form-label">CV</label>
        		<input name="cv" type="number" class="up form-control col-sm-10"
        		id="inputCv" value="{{ old('cv') }}">
        	</div>
        	
        	<div class="form-group col-sm-2">
        		<label for="inputYear" class="col-sm-2 col-form-label">Año</label>
        		<input name="year" type="number" class="up form-control col-sm-10"
        		id="inputYear" value="{{ old('year') }}">
        	</div>
        	
        	<div class="form-group col-sm-2">
        		<label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
        		<input name="precio" type="number" class="up form-control col-sm-4"
        		id="inputPrecio" step="10" value="{{ old('precio') }}">
        	</div>
    	</div>
    	
    	<div class="form-group row my-3">
    		<div class="form-check col-sm-3">
    			<input name="matriculada" value="1" class="form-check-input my-3" id="chkMatriculada"
    			type="checkbox" {{ old('matriculada')? "checked" : "" }}>
    			<label for="chkMatriculada" class="form-check-label my-3">Matriculada</label>
    		</div>
    		<div class="form-check col-sm-5">
        		<label for="inputMatricula" class="col-sm-3 form-label">Matrícula</label>
        		<input name="matricula" type="text" class="up form-control col-sm-3 my-3"
        			id="inputMatricula" maxlength="7" value="{{ old('matricula') }}">
        	</div>
        	<div class="form-check col-sm-3">
        		<label for="inputColor" class="col-sm-2 form-label">Color</label>
        		<input name="color" type="color" class="up form-control form-control-color"
        			id="inputColor" value="{{ old('color') ?? '#FFFFFF' }}">
        	</div>
    	</div>
    	
    	<script>
    		inputMatricula.disabled = !chkMatriculada.checked;
    		
    		chkMatriculada.onchange = function(){
    			inputMatricula.disabled = !chkMatriculada.checked;
    		}
    	</script>
 
    	<div class="form-group row">
    		<label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
    		<input name="imagen" type="file" class="form-control-file col-sm-10" id="inputImagen">
    	</div>
    	
    	<div class="form-group row">
    		<button type="submit" class="btn btn-success m-1 mt-5">Guardar</button>
    		<button type="reset" class="btn btn-secondary m-1">Borrar</button>
    	</div>
    	
    </form>
@endsection

@section('enlaces')
	@parent
	<a href="{{ route('bikes.index') }}" class="btn btn-primary my-1 mr-2">Garaje</a>
@endsection

