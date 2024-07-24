<!DOCTYPE html>
<html lang="es">
    <head>
    	<meta charset="UTF-8">
    	<style>
    	   <!-- Truco para usar Bootstrap en nuestro email -->
    	   
    	   @php
    	       include 'css/bootstrap.min.css';
    	   @endphp
    	</style>
    </head>
    <body class="container p-3">
    	<header class="container row bg-light p-4 my-4">
    		<h1 class="col-8">{{ config('app.name') }}</h1>	
    	</header>
    	<main>
    		<h1>Tu noticia fue evaluada por nuestros editores, su decisión fue:</h1>
    		<p>{{ $mensaje }}</p>
    	</main>
       <footer class="page-footer font-small p-4 my-4 bg-light">
        	<p>Aplicación creada por {{ $autor }} para {{ $centro }} como ejemplo de clase.
        	Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
    </body>
</html>