<!DOCTYPE html>
<html lang="es">
    <head>
    	<!-- Etiquetas META -->
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="Aplicación de gestión de motos Larabikes">
    	
    	<!-- Título de la página -->
        <title>{{config('app.name')}} - @yield('subtitulo')</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        
        <!-- Carga del CSS de Bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body class="container p-3">
        <!-- PARTE SUPERIOR (menú) -->
        
        @env(['local','test'])
       		<x-env :mode="App::environment()"/>
        @endenv
        
        @section('navegacion')
        @php($pagina = Route::currentRouteName())
        <nav>
        	<ul class="nav nav-pills my-3">
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'portada'? 'active' : ''}}" href="{{route('portada')}}">Inicio</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'bikes.index' ||
        			 $pagina == 'bikes.search'?'active' : ''}}" href="{{route('bikes.index')}}">Garaje</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'bikes.create'? 'active' : ''}}" href="{{route('bikes.create')}}">Nueva moto</a>	
        		</li>
        	</ul>	

        	<p>Catálogo total de {{ $total }} motos</p>
        	
        </nav>
        @show
        
        <!-- PARTE CENTRAL -->
        <main>
        	<h1>@yield('titulo')</h1>
        	<h2>@yield('subtitulo')</h2>
        	
        	@if(Session::has('success'))
        		<x-alert type="success" message="{{ Session::get('success') }}"/>
        	@endif
        	
        	@if($errors->any())
        		<x-alert type="danger" message="Se han producido errores:">
        			<ul>
        				@foreach ($errors->all() as $error)
        					<li>{{ $error }}</li>
        				@endforeach
        			</ul>
        		</x-alert>
        	@endif
        	
        	@yield('contenido')
        
        	<div class="btn-group" role="group" aria-label="Links">
        		@section('enlaces')
					<a href="{{route('portada')}}" class="btn btn-primary mr-2">Inicio</a>
				@show
			</div>
			
		
        </main>
        
        <!-- PARTE INFERIOR -->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
        	<p>Aplicación creada por Robert Sallent como ejemplo de clase.
        	Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
        @show
    </body>
</html>
