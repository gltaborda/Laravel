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
        
        <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
        
        
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
        			<a class="nav-link {{ $pagina == 'portada'? 'active' : '' }}" 
        				href="{{ route('portada') }}">Inicio</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina == 'noticias.index' ||
        			 	$pagina == 'noticias.search'?'active' : ''}}" 
        			 	href="{{ route('noticias.index') }}">Garaje</a>	
        		</li>
        		<li class="nav-item mr-2">
        			<a class="nav-link {{ $pagina == 'contacto'?'active' : '' }}" 
        				href="{{ route('contacto') }}">Contacto</a>	
        		</li>
        		@auth
            		<li class="nav-item mr-2">
            			<a class="nav-link {{ $pagina == 'noticias.create'? 'active' : '' }}" 
            				href="{{ route('noticias.create') }}">Nueva noticia</a>	
            		</li>
            	@endauth
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item ms-auto mr-2">
                            <a class="nav-link {{ $pagina == 'login'? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item mr-2">
                            <a class="nav-link {{ $pagina == 'register'? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item ms-auto dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} ({{ Auth::user()->email }})
                        </a>
						
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">
								Perfil
							</a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
        	</ul>
        	
        	

        	
        
        @auth
        	@if( !Auth::user()->email_verified_at)
        		<div class="alert alert-info">
                   {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
        	@endif
        @endauth
        	
        </nav>
        @show
        
        <!-- PARTE CENTRAL -->
        <main>
        	<h1>@yield('titulo')</h1>
        	<h2>@yield('subtitulo')</h2>
        	
        	@if(Session::has('success'))
        		<x-alert type="success" message="{{ Session::get('success') }}"/>
        	@endif
        	
        	@if(Session::has('warning'))
        		<x-alert type="warning" message="{{ Session::get('warning') }}"/>
        	@endif
        	
        	@if($errors->any())
        		<x-alert type="danger" message="Se han producido los siguientes errores:">
        			<ul>
        				@foreach ($errors->all() as $error)
        					<li>{{ $error }}</li>
        				@endforeach
        			</ul>
        		</x-alert>
        	@endif
        	
        	@yield('content')
        
        	
			
		
        </main>
        
        <div class="btn-group" role="group" aria-label="Links">
    		@section('enlaces')
				<a href="{{route('portada')}}" class="btn btn-primary my-1 mr-2">Inicio</a>
			@show
		</div>
        
        <!-- PARTE INFERIOR -->
        @section('pie')
        <footer class="page-footer font-small p-2 bg-light">
        	<p>Aplicación creada por  como proyecto de fin de curso.
        	Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
        @show
    </body>
</html>
