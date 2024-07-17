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
    		<figure class="img-fluid col-2">
    			<img src="{{ asset('/images/logos/logo.png') }}" alt="logo">
    		</figure>
    		<h1 class="col-8">{{ config('app.name') }}</h1>	
    	</header>
    	<main>
    		<h1>Felicidades</h1>
    		<h2>¡Has publicado tu primera moto en LaraBikes!</h2>
    		<p>Tu nueva moto {{ $bike->marca.' '.$bike->modelo }} ya
    		aparece en los resultados.</p>
    		<p>Sigue así, estás colaborando para que LaraBikes se convierta
    		en la primera red de usuario de motocicletas de los CIFO.</p>
    	</main>
       <footer class="page-footer font-small p-4 my-4 bg-light">
        	<p>Aplicación creada por {{ $autor }} para {{ $centro }} como ejemplo de clase.
        	Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
    </body>
</html>