@extends('layouts.documentosTemplate')

@section('content')
<!------------------MAIN-CONTAINER----------------->
   
<div class="col-md-12" style="padding: 10px"> 

		<h2>Crear un nuevo Documento</h1>

		<!-- HR es una separacion para que se vea mejor -->
		<hr>

		<!-- ----FORMULARIO ----- -->
		<!-- Cuando utilizo ROUTE() uso el nombre de la ruta en el controlador. No importa que cambie el nombre del URL siempore nos va a dirigir a la ruta. En caso de usar URL() tenemos que usar el URL del controlador -->
		<form action="{{route('saveDoc')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
			<!-- Laravel nos obliga a proteger los formularios con CSRF-->
			{!! csrf_field() !!}

			<!----- MOSTRAR ERRORES------>

			@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					<!-- Que recorra cada error y lo muestre en formato de lista. El idioma de los texto se cambia en CONFIG>APP.PHP. Pero necesito crear las carpetas de traducciones en la carpeta LANG -->

					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>				
			</div>
			@endif
			<!----- /MOSTRAR ERRORES------>

			<!-- ----FORM-GROUPS ----- -->
			<div class="form-group">
				<label for="title">Titulo</label>
				<input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" />
			</div>

			<div class="form-group">
				<label for="description">Descripcion</label>
				<textarea class="form-control" id="description" name="description">	{{old('description')}}
				</textarea> 
			</div>

			<div class="form-group">
				<label for="doc">Documento</label>
				<input type="file" class="form-control" id="doc" name="doc"/>
			</div>
			<!-- ----/FORM-GROUPS ----- -->

			<button type="submit" class="btn btn-success">
				CREAR
			</button>
		</form>
		<!-- ----/FORMULARIO ----- -->

	</div>
	<!--------------/MAIN-ROW------------->


<!------------------/MAIN-CONTAINER----------------->
@endsection