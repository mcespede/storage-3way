@extends('layouts.app')

@section('content')
<!-- -----MAIN-CONTAINER -------->
<!-- El offset se utiliza para meter una columna por delante y otra por detras para que quede mas centrada la informacion en la pantalla -->
<div class="col-md-10 col-md-offset-1">
	<h2>
		{{$video->title}}
	</h2>
	<hr>
	<div class="col-md-8">
		<!------CARGAR EL VIDEO------>
		<!-- Esto es un etiqueta de HTML5-->
		<video controls="" id="video-player">
			<!-- SOURCE me va a buscar el video y cargarlo. Le pasamos el nombre de la ruta y como segundo parametro que nos llega por URL.
			Le pasamos el (video_path) que es la propieda donde esta guardada la ruta -->
			<source src="{{route('fileVideo', ['filename' => $video->video_path]) }}"></source>
			<!-- En caso de que no funcionde el source damos un mensaje de error-->
			Tu navegador no es compatible con HTML5
		</video>
		<!------ DESCRIPCION DEL VIDEO------>
		<div class="panel panel-success video-data ">
			<div class="panel-heading class">
				<div class="panel-title">
					<!-- Aqui voy a utilizar un helper para poder formatear las fechas. Utilizo el helper y el metodo dentro del helper, y finalmente le paso mi fecha para formatear-->
					Subido por <strong><a href="{{route('channel',['user_id'=>$video->user_id])}}">{{$video->user->name.' '.$video->user->surname}}</a></strong> {{\FormatTime::LongTimeFilter($video->created_at)}}
				</div>
			</div>
			<div class="panel-body">
				{{$video->description}}
			</div>

		</div>
		<!------VIDEO   ------>
		<!--Para los comentario aprovecha la funcion de INCLUDE y lo hago aparte para que no sea pesado el codigo todo en la misma pagina-->
		<!-- Solo se meustran los comentarios a los usuarios identificados -->

			@include('video.comments')
	</div>

</div>
@endsection