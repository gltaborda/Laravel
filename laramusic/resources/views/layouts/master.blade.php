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
        	<ul class="nav nav-pills my-2">
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'portada'? 'active' : ''}}" href="{{route('portada')}}">Inicio</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'instruments.index' ||
        			 $pagina == 'instruments.search'?'active' : ''}}" href="{{route('instruments.index')}}">Garaje</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'instruments.create'? 'active' : ''}}" href="{{route('instruments.create')}}">Nueva moto</a>	
        		</li>
        	</ul>	

        	<p>Catálogo total de  instrumentos</p>
        	
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
        
        	
			
		
        </main>
        
        <div class="btn-group" role="group" aria-label="Links">
    		@section('enlaces')
				<a href="{{route('portada')}}" class="btn btn-primary my-1 mr-2">Inicio</a>
			@show
		</div>
        
        <!-- PARTE INFERIOR -->
        @section('pie')
        <footer class="page-footer font-small p-2 bg-light">
        	<p>Aplicación creada por {{ $autor }} como ejemplo de clase.
        	Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
        @show
    </body>
</html>
