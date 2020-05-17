@extends('layouts.app')

@section('title','Página de inicio')

<!-- ---------HOME-PAGE-TABS---------->
@section('tabs')
	@include('layouts.tabs.homePage.homePageTabs')
@endsection
<!-- ---------/MAIN-PAGE-TABS---------->

<!-- ---------MAIN-PAGE-CONTENT---------->
@section('content')
<!-- Esto es como sifuera el layout de app, comienza de cero
	para que todo lo que se hga click en la barra se refleje solo aqui 
	manteniendo el layout principal -->

	<div class="col-md-10" style="padding-top: 10px">	
		<div class="row col-md-12">
			<div class="panel panel-success">
					@yield('encabezado')	
			</div>
		</div>

		<div class="row">

			@yield('contentMain')
		</div>			
	</div>	
@endsection
<!-- ---------/MAIN-PAGE-CONTENT---------->

<!------------ GENERAL-SEARCHBAR ---------->
@section('searchBar')
	@include('layouts.searchBars.videoBar')
@endsection
<!------------ /GENERAL-SEARCHBAR ---------->

<!-- ---------MAIN-PAGE-SIDEBAR---------->
@section('sideBar')
	@include('layouts.sideBars.mainSideBar')
@endsection
<!-- ---------MAIN-PAGE-SIDEBAR---------->