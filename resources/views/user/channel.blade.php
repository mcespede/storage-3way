@extends('layouts.app')
@section('content')
@section('content')

<div class="container">
    <div class="row">

        <!----------------------------------------->
      	<div class="container">
   	         		<!--Vamos a saber lo que estamos buscando--->
					<h2>Canal de {{$user->name.' '.$user->surname.' '.$user->surname}}</h2>     				

			<div class="clearfix"></div>
	        @include('video.videosList')
	    </div>
        <!----------------------------------------->     		


    </div>
</div>

@endsection