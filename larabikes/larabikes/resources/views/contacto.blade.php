@extends('layouts.master')

@section('titulo', 'Contactar con Larabikes')

@section('subtitulo')
@endsection

@section('contenido')
	<div class="container row">
		<form class="col-7 my-2 border p-4" method="POST" enctype="multipart/form-data"
			action="{{ route('contacto.email') }}">
			@csrf
			<div class="form-group row">
				<label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
				<input name="email" type="email" class="up form-control" id="inputEmail"
					placheholder="Email" maxlength="255" required="required" 
					value="{{ old('email') }}">
			</div>
			<div class="form-group row">
				<label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
				<input name="nombre" type="text" class="up form-control" id="inputNombre"
					placheholder="Nombre" maxlength="255" required="required" 
					value="{{ old('nombre') }}">
			</div>
			<div class="form-group row">
				<label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
				<input name="asunto" type="text" class="up form-control" id="inputAsunto"
					placheholder="asunto" maxlength="255" required="required" 
					value="{{ old('asunto') }}">
			</div>
			<div class="form-group row">
				<label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
				<textarea name="mensaje" id="inputMensaje" placheholder="mensaje" 
					maxlength="255" required="required">{{ old('mensaje') }}</textarea>
			</div>
			<div class="form-group row my-4">
				<label for="inputFichero" class="form-label">Fichero (gif):</label>
				<input name="fichero" type="file" class="form-control-file" id="inputFichero" 
					accept="image/gif">
			</div>
			<div class="form-group row">
        		<button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
        		<button type="reset" class="btn btn-secondary m-2">Borrar</button>
        	</div>
		</form>
		
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.640110085127!2d2.055550976925829!3d41.55538897127906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4952ef0b8c6e9%3A0xb6f080d2f180b111!2sCIFO%20Valles!5e0!3m2!1ses-419!2ses!4v1720003041285!5m2!1ses-419!2ses"
			style="min-width:300px; min-height: 300px;" loading="lazy"
			class="col-5 my-2 border p-3" referrerpolicy="no-referrer-when-downgrade">
		</iframe>
	</div>
	
@endsection

@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary my-1 mr-2">Garaje</a>
@endsection


        