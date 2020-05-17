@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/polaroidPics.css') }}" rel="stylesheet">
@endpush

@section('title','Bienvenidos')

<!-- ---------MAIN-PAGE-TABS---------->
@section('tabs')
	@include('layouts.tabs.mainPage.mainPageTabs')
@endsection
<!-- ---------/MAIN-PAGE-TABS---------->

<!-- ---------MAIN-PAGE-CONTENT---------->

@section('content')
<!-- Esto es como sifuera el layout de app, comienza de cero
	para que todo lo que se hga click en la barra se refleje solo aqui 
	manteniendo el layout principal -->
	<div class="col-md-10" style="padding-top: 10px">
		<div class="row">

<div class="polaroid rotate_right">
  <img src="{{ URL::to('/') }}/DSC06584.JPG" alt="Pulpit rock" width="50%" height="auto">
  <p class="caption">The pulpit rock in Lysefjorden, Norway.</p>
</div>

<div class="polaroid rotate_left">
  <img src="{{ URL::to('/') }}/DSC06584.JPG" alt="Monterosso al Mare" width="50%" height="auto">
  <p class="caption">Monterosso al Mare. One of the five villages in Cinque Terre, Italy.</p>
</div>
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