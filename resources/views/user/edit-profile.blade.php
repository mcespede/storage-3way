@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h2>Perfil de {{$userProfile->name}}</h1>

			<!-- HR es una separacion para que se vea mejor -->
			<hr>

			<!-- ----FORMULARIO ----- -->
			<!-- Cuando utilizo ROUTE() uso el nombre de la ruta en el controlador. No importa que cambie el nombre del URL siempore nos va a dirigir a la ruta. En caso de usar URL() tenemos que usar el URL del controlador -->
			<!-- Tengo que pasarle en un array el video ID-->
			<form action="{{route('updateUser',['id'=>$userProfile->id])}}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
					<label for="name">Name</label>
					<!-- Para repoblar el formulario  como VALUE le imprimo la propiedad del objeto que deseo visualizar-->
					<input type="text" class="form-control" id="name" name="name" value="{{$userProfile->name}}"/>
				</div>
<!----------------------------------------------------------------------------------------------->
				<div class="form-group">
					<label for="surname">LastName</label>
					<textarea class="form-control" id="surname" name="surname">	{{$userProfile->surname}}
					</textarea> 
				</div>
<!----------------------------------------------------------------------------------------------->
				<div class="form-group">
					<label for="alias">Alias</label>
					<textarea class="form-control" id="alias" name="alias">	{{$userProfile->alias}}
					</textarea> 
				</div>
<!----------------------------------------------------------------------------------------------->

				<!-- ----/FORM-GROUPS ----- -->
<!----------------------------------------------------------------------------------------------->
				<button type="submit" class="btn btn-success">
					Modificar
				</button>
			</form>
			<!-- ----/FORMULARIO ----- -->
		</div>
	</div>
@endsection