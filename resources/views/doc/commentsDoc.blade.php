<h4>Comentarios</h4>
<!--Aqui le pones la ACTION para que utilice la ruta URL  para guardar comentarios-->

<!--QUe imprima un mensaje si sie subio correctamente el comentario-->
 @if(session('message'))
    <div class="alert alert-success">
       {{session('message')}}
     </div>
 @endif

@if(Auth::check())
<form class="col-md-4" method="POST" action="{{route('commentDoc') }}">

	{!! csrf_field() !!}
	<!--HIDDEN para pasar el Id del doc donde se va a añadir el comentario-->
	<input type="hidden" name="doc_id" value="{{$doc->id}}" required/>
	<p>
		<textarea class="form-control" name="body" required="">			
		</textarea>
	</p>
	<input type="submit" value="Comentar" class="btn btn-success"/>
</form>
<!-- Este clear fix lo agrego para limpiar lo flotado y separar el boton de enviar con los comentarios -->
<div class="clearfix"></div>
<br>
@endif

<!------------------------------------------------------------------------ -->
<!------------------------LIST-COMMENTS---------------------------------- -->
<!------------------------------------------------------------------------ -->

<!-- Ahora vamos a verificar si existen comentarios , y si existen que los muestre -->
@if(isset($doc ->comments))
<div id="comments-list">
	<!-- Si existen los comentario que me los recorra todos -->
	@foreach($doc -> comments as $comment)
		<!-- VOy a ir mostrando cada comentario dentro de un aetiqueta -->
		<div class="comment-item" col-md-12 pull-left>
			<!-- -------PANEL-BOOTSTRAP------------->
			<div class="panel panel-default comment-data col-md-12">
			<div class="panel-heading class">
				<div class="panel-title">
					<!-- Aqui voy a utilizar un helper para poder formatear las fechas. Utilizo el helper y el metodo dentro del helper, y finalmente le paso mi fecha para formatear-->
					Subido por <strong>{{$comment->user->name.' '.$comment->user->surname}}</strong> {{\FormatTime::LongTimeFilter($comment->created_at)}}
				</div>
			</div>
			<div class="panel-body">
				{{$comment->body}}
				<!-- -----BORRAR COMMENTARIOS  ----->
				<!-- Los comentarios so los podra borrar la persona que creo los comentarios o el dueño del doc. Si la persona hizo un comentario en un doc que no es suyo tambien lo podra borrar. Es decir pueden borrar comentarios el creador del doc y el creador del comentario-->

				<!-- Si el ID del USER autenticado en igual al ID del comentario podra borra el comentario -->

				<!-- O si el usuario identificado en el que ha creado este doc podra eliminar el comentario. Va a poder ver el boton -->
				@if(Auth::check()&&(Auth::user()->id == $comment-> user->id || Auth::user()->id == $doc-> user->id))
					<!-- Podremos un boton y nos saca un overlay que nos pregunta si queremos borrar el comentario o no-->
					<!-- Para ello utilizamos un OVERLAY de BOOTSTRAP -->
					<!-- Esto es para que nos aparezca del lado derecho -->
					<div class="pull-right">
					<!---------------------------------------------------------------------------->
					<!---------------------------OVERLAY------------------------------------------>
					<!-- Botón en HTML (lanza el modal en Bootstrap) -->
					<!-- Lo primero que tengo es un boton que nos hace ancla al DIV de abajo con id="vidtorModal"
					Hay que indicarle el ID del comentario para que no sean todos los mismos modals. Es decir para que cada ventanita y cada boton sea diferente. Sino me sale el mismo siempre ({{$comment->id}})-->
					<a href="#victorModal{{$comment->id}}" role="button" class="btn btn-sm btn-danger" data-toggle="modal"><span class="glyphicon glyphicon-trash"></a>
  
					<!-- Modal / Ventana / Overlay en HTML -->
					<div id="victorModal{{$comment->id}}" class="modal fade">
    					<div class="modal-dialog">
        					<div class="modal-content">
            					<div class="modal-header">
                					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                					<h4 class="modal-title">¿Estás seguro?</h4>
            					</div>
            				<div class="modal-body">
                				<p>¿Seguro que quieres borrar este comentario?</p>
                				<p class="text-warning"><small>{{$comment->body}}</small></p>
            				</div>
            				<div class="modal-footer">
                				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                				<!-- Para poder borrar losc comentarios tengo que hacer un nuevo metodo en el controlador de comentarios. Le paso por parametro a la ruta el ID del comentario que deseo borrar--> 
                				<a href="{{url('/delete-comment-doc/'.$comment->id)}}" type="button" class="btn btn-danger">Eliminar</a>
            				</div>
        					</div>
    					</div>
					</div>

					<!---------------------------/OVERLAY---------------------------------------->
					</div>
				@endif
			</div>

			</div>
			<!-- -------/PANEL-BOOTSTRAP------------->


		</div>
	@endforeach
</div>
@endif