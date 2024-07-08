@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-8">
        	<div class="card">
            	<div class="card-header">Perfil de {{ Auth::user()->name }}</div>
           		<div class="card-body">
                    <table class="table">
                		<tr>
                			<td>Nombre</td>
                			<td>{{ Auth::user()->name }}</td>
                		</tr>
                		<tr>
                			<td>E-mail</td>
                			<td>{{ Auth::user()->email }}</td>
                		</tr>
                		<tr>
                			<td>Población</td>
                			<td>{{ Auth::user()->poblacion }}</td>
                		</tr>
                		<tr>
                			<td>Código postal</td>
                			<td>{{ Auth::user()->codigo_postal }}</td>
                		</tr>
                		<tr>
                			<td>Fecha de nacimiento</td>
                			<td>{{ Auth::user()->fecha_nacimiento }}</td>
                		</tr>
                		<tr>
                			<td>Miembro desde</td>
                			<td>{{ Auth::user()->created_at }}</td>
                		</tr>
                		<tr>
                			<td>Verificado</td>
                			<td>{{ Auth::user()->email_verified_at? 'Si' : 'No' }}</td>
                		</tr>
                	</table>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
