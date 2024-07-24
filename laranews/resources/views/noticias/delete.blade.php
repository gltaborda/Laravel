@extends('layouts.master')

@section('titulo', "Confirmación de borrado de noticia #$noticia->id")

@section('subtitulo', 'Borrar noticia')
        
@section('contenido')
	<form method="POST" class="my-2 border p-5" action="{{URL::signedRoute('noticias.destroy', $noticia->id)}}">
		@csrf
		@method('DELETE')
		<figure>
			<figcaption>Imagen actual:</figcaption>
			<img class="rounded" style="max-width: 400px"
        		alt="Imagen de noticia #{{$noticia->id}}"
        		title="Imagen de noticia #{{$noticia->id}}"
        		src="{{$noticia->imagen?
        			asset('storage/'.config('filesystems.noticiasImageDir')).'/'.$noticia->imagen:
        			asset('storage/'.config('filesystems.noticiasImageDir')).'/default.jpg'}}">
    		
    		
		</figure>
		<label for="confirmdelete">Seguro que quiere borrar la noticia #
    			{{ "$noticia->id" }}?</label>
    			
		<input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-1"
    			value="Borrar" id="confirmdelete">
	</form>	
@endsection

@section('enlaces')
	@parent
    <a href="{{route('noticias.show',$noticia->id)}}" class="btn btn-secondary my-1 mr-2">Volver a detalles</a>
@endsection