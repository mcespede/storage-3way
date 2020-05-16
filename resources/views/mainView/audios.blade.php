@extends('welcome')


@section('encabezado')
        <h4>Audios</h4>
@endsection

@section('contentMain')

    @include('layouts.sectionAlert')

    <div class="container">
        <div class="row">

            <!----------------------------------------->
            <div class="container">
                <!-- Mostrar el mensaje cuando creo un nuevo video. Compruebo si existe mensaje-->

                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif

                @include('audio.audiosList')
            </div>
            <!----------------------------------------->
        </div>
    </div>
@endsection