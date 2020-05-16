@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <!----------------------------------------->

				<div class="col-md-8">
					<!--Vamos a saber lo que estamos buscando--->
					<h2>Busqueda {{$search}}</h2>   					
				</div>

  				<div class="col-md-4">
  					<!-- Esta es una forma de poder ordenar y escojer que deseo seleccionar
					LE concatenamos el termino de la busqueda-->
					<form class="pull-right" action="{{url('/buscar/'.$search)}}" method="get">
						<label for="filter">Ordenar</label>
						<!-- FIlter es como se va a llamar el parametro que vamos a enviar al controlador-->
						<select name="filter" class="form-control">
							<option value="new">Mas nuevos primero</option>
							<option value="old">Mas antiguos primero</option>
							<option value="alfa">De la A a la Z</option>
						</select>
							<!-- Agrego la clase BTN-FILTER para poder separa un poco el boton del filtro-->
						<input type="submit" value="Ordenar" class="filter btn btn-sm btn-primary">
					</form>	
  				</div>

			<div class="clearfix"></div>
	        @include('doc.docsList')       

        <!----------------------------------------->     		
    </div>
</div>
@endsection