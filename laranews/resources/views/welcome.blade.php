@extends('layouts.master')

@section('titulo', 'Bienvenido a Laranews')

@section('subtitulo', 'Listado de noticias')
        
@section('contenido')	
	<div class="row">
		<div class="col-6 text-start">{{ $noticias->links() }}</div>
		@auth
			@can('create', App\Models\Noticia::class)
    		<div class="col-6 text-end">
    			<p>Nueva noticia <a href="{{ route('noticias.create') }}"
    				class="btn btn-success ml-2">+</a></p>
    		</div>
    		@endcan
		@endauth
	</div>

	<form method="GET" class="col-6 row" action="{{ route('noticias.search') }}">
	
		<input name="titulo" type="text" class="col form-control m-2" 
		placeholder="titulo" maxlength="16" value="{{ $titulo ?? '' }}">
		
		<div class="form-group col text-end m-2">
    		<select class="form-control w-auto d-inline" name="tema" placeholder="tema">
    			<option value="" selected>Tema</option>
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

        <button type="submit" class="col btn btn-primary btn-sm mr-2 my-2">Buscar</button>	
        	
        <a href="{{ route('noticias.index') }}" class="col btn btn-secondary btn-sm mr-2 my-2" role="button">Quitar filtro</a>	

	</form>
		
	<div class="card-columns">
	@foreach($noticias as $noticia)
		<div class="card mx-auto my-3" style="width: 40rem;">
    		<h5><b>{{ $noticia->tema }}</b></h5>
    		<img class="card-img-top border rounded" src="{{ $noticia->imagen?
            			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen :
            			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg' }}">
    		<div class="card-body">
    			<h2 class="card-title text-center"><b>{{ $noticia->titulo }}</b></h2>
    			<p class="card-text">{{ substr($noticia->texto, 0, 40) }}...</p>
    			<a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-primary">Ver más</a>
    		</div>
    	</div>
	@endforeach
	</div>

	<div>{{ $noticias->links() }}</div>
	<div class="text-end" >Mostrando {{ sizeof($noticias) }} de {{ $noticias->total() }} noticias</div>

@endsection 