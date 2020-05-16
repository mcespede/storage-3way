@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
		<div><h2>{{$doc->title}}</h2>
			<hr>
			<div class="col-md-12">
				<!------CARGAR EL DOC------>
				<!-- Esto es un etiqueta de HTML5-->
				<iframe src="{{route('fileDoc', ['filename' => $doc->doc_path]) }}">
					
				</iframe>

				<!------ DESCRIPCION DEL DOC------>
				<div class="panel panel-success doc-data ">
					<div class="panel-heading class">
						<div class="panel-title">
							<!-- Aqui voy a utilizar un helper para poder formatear las fechas. Utilizo el helper y el metodo dentro del helper, y finalmente le paso mi fecha para formatear-->
							Subido por <strong><a href="{{route('channel',['user_id'=>$doc->user_id])}}">{{$doc->user->name.' '.$doc->user->surname}}</a></strong> {{\FormatTime::LongTimeFilter($doc->created_at)}}
						</div>
					</div>
					<div class="panel-body">
						{{$doc->description}}
					</div>
				</div>

				<!------DOC   ------>
				<!--Para los comentario aprovecha la funcion de INCLUDE y lo hago aparte para que no sea pesado el codigo todo en la misma pagina-->
				<!-- Solo se meustran los comentarios a los usuarios identificados -->

					@include('doc.commentsDoc')
			</div>
		</div>
	</div>
</div>
@endsection