@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel-edicion-user panel panel-default col-md-8">
			<!------------------------------------->
			<div class="panel-heading">
				Perfil de {{$userProfile->name.' '.$userProfile->surname}}
			</div>

			<!-- HR es una separacion para que se vea mejor -->
			<hr>
			<!---------------------------BODY---------------------------------------->
			<div class="panel-body">
				<!----------------------IMAGE-FORM---------------------------------------->
				<div class="video-image-thumb col-md-4 pull-left">
                     <!--Le meto un video-image-mask para poder manipularla desde CSS-->
                    <!---------------FORM----------------->
                    <form action="{{route('updateUser',['id'=>$userProfile->id])}}" method="post" enctype="multipart/form-data">

                      <div class="profile-image">
                            <!-- Le concateno a la ruta minitura la imagen que quiero ver, en este caso la que pertenezca al fichero que recibo por URL. Tambien le ponemos una clase para poder reducir su tamaño con CSS file-->
                            <img class="image-responsive" src="/profileDefaultImage.jpg"/>
                            <input type="file" class="form-control" id="image" name="image"/>
                       </div>
                   	</form>
                   	<!---------------FORM----------------->
                </div>
                <!----------------------/IMAGE-FORM---------------------------------------->

                <!------------------------------------------------------------------------->
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
						<label for="name">Nombre</label>
						<!-- Para repoblar el formulario  como VALUE le imprimo la propiedad del objeto que deseo visualizar-->
						<input type="text" class="form-control" id="name" name="name" value="{{$userProfile->name}}"/>
					</div>
					<!----------------------------------------------------------------------------->
					<div class="form-group">
						<label for="surname">Apellido</label>
						<input type="text" class="form-control" id="surname" name="surname" value="{{$userProfile->surname}}" />	
					</div>
	<!----------------------------------------------------------------------------------------------->
					<div class="form-group">
						<label for="alias">Alias/Apodo</label>
						<input type="text" class="form-control" id="alias" name="alias" value="{{$userProfile->alias}}"/>						 
					</div>
	<!----------------------------------------------------------------------------------------------->

					<div class="form-group">
						<label for="email">E-mail</label>
						<input readonly type="text" class="form-control" id="email" name="email" value="{{$userProfile->email}}"/>						 
					</div>
	<!----------------------------------------------------------------------------------------------->
					<div class="form-group">
						<label for="member">Miembro desde</label>
						<input readonly type="text" class="form-control" id="member" name="member" value="{{$userProfile->created_at}}"/>

					</div>
	<!----------------------------------------------------------------------------------------------->
					<div class="form-group">
						<label for="update">Última actualización</label>
						<input readonly type="text" class="form-control" id="update" name="member" value="{{\FormatTime::LongTimeFilter($userProfile->updated_at)}}"/>						 
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
			<!---------------------------/BODY---------------------------------------->
		</div>
	</div>
@endsection