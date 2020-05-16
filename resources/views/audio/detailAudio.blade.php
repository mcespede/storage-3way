@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
		<div><h2>{{$audio->title}}</h2>
			<hr>
			<div class="col-md-12">
				<!------CARGAR EL AUDIO------>
				<!-- Esto es un etiqueta de HTML5-->
				<audio controls>
					<!-- SOURCE me va a buscar el video y cargarlo. Le pasamos el nombre de la ruta y como segundo parametro que nos llega por URL.
					Le pasamos el (video_path) que es la propieda donde esta guardada la ruta -->
					<source src="{{route('fileAudio', ['filename' => $audio->audio_path]) }}"></source>
					<!-- En caso de que no funcionde el source damos un mensaje de error-->
					Tu navegador no es compatible con HTML5
				</audio>
				<!------ DESCRIPCION DEL VIDEO------>
				<div class="panel panel-success video-data ">
					<div class="panel-heading class">
						<div class="panel-title">
							<!-- Aqui voy a utilizar un helper para poder formatear las fechas. Utilizo el helper y el metodo dentro del helper, y finalmente le paso mi fecha para formatear-->
							Subido por <strong><a href="{{route('channel',['user_id'=>$audio->user_id])}}">{{$audio->user->name.' '.$audio->user->surname}}</a></strong> {{\FormatTime::LongTimeFilter($audio->created_at)}}
						</div>
					</div>
					<div class="panel-body">
						{{$audio->description}}
					</div>
				</div>

				<!------VIDEO   ------>
				<!--Para los comentario aprovecha la funcion de INCLUDE y lo hago aparte para que no sea pesado el codigo todo en la misma pagina-->
				<!-- Solo se meustran los comentarios a los usuarios identificados -->

					@include('audio.commentsAudio')
			</div>
		</div>
	</div>
</div>
@endsection