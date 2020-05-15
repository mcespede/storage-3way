@extends('layouts.app')

@section('title','Página de inicio')

@section('sideBar')
	@include('layouts.sideBars.mainSideBar')
@endsection

@section('content')
<!-- Esto es como sifuera el layout de app, comienza de cero
	para que todo lo que se hga click en la barra se refleje solo aqui 
	manteniendo el layout principal -->
	@include('layouts.navBars.topNavBar')

	<div class="col-md-10">	
		<div class="row col-md-12">
			<div class="panel panel-success">
				<h3>
					@yield('encabezado')
				</h3>
			</div>

		</div>

		<div class="row">
			@yield('contentMain')
		</div>	
		
	</div>
	

@endsection