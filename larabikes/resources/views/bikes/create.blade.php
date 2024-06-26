@extends('layouts.master')

@section('titulo', 'Gestor de motos Larabikes')

@section('subtitulo', 'Nueva moto')

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{route('bikes.store')}}">
    	@csrf
    	<div class="form-group row">
    		<label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
    		<input name="marca" type="text" class="up form-control col-sm-10"
    		id="inputMarca" placeholder="Marca" value="{{old('marca')}}">
    	</div>
    	
    	<div class="form-group row">
    		<label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
    		<input name="modelo" type="text" class="up form-control col-sm-10"
    		id="inputModelo" placeholder="Modelo" value="{{old('modelo')}}">
    	</div>
    	
    	<div class="form-group row">
    		<label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
    		<input name="kms" type="number" class="up form-control col-sm-10"
    		id="inputkms" value="{{old('kms')}}">
    	</div>
    	
    	<div class="form-group row">
    		<label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
    		<input name="precio" type="number" class="up form-control col-sm-4"
    		id="inputPrecio" step="10" value="{{old('precio')}}">
    	</div>
    	
    	<div class="form-group row">
    		<div class="form-check">
    			<input name="matriculada" value="1" class="form-check-input"
    			type="checkbox" {{old('matriculada')? "checked" : ""}}>
    			<label class="form-check-label">Matriculada</label>
    		</div>
    	</div>
    	
    	<div class="form-group row">
    		<button type="submit" class="btn btn-success m-1 mt-5">Guardar</button>
    		<button type="reset" class="btn btn-secondary m-1">Borrar</button>
    	</div>
    </form>
@endsection

@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary my-1 mr-2">Garaje</a>
@endsection

