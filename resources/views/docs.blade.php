<!-- Esta es la pagina principal de videos cuando CLICK en el NAVBAR principal-->
<!--Utilizamos en template de VIDEOS 
	Cada pagina que necesite hacer cambios dentro de la misma pagina necesita 
	un template.-->
@extends('layouts.documentosTemplate')

@section('alerts')
	@include('layouts.sectionAlert')
@endsection

<!-- La seccion contenido en la que cambia en el template de videos
	todo lo demas se mantiene igual
	De esta forma pudo realizar diferentes operaciones manteniendo el mismo template-->
@section('content')
    @include('doc.docsList')
@endsection
