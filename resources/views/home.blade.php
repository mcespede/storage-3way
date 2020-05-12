@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <!----------------------------------------->
                <!-- Mostrar el mensaje cuando creo un nuevo video. Compruebo si existe mensaje-->

                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif

                @include('video.videosList')
            <!-----------------------------------------> 
        </div>

        <div class="col-md-4">
          @include('layouts.sideMenuHome')
        </div>

    </div>

</div>
@endsection