
    <!-- Ahora vamos a recorrer todos los audios que existen , utilizando el metodo PAGINATE que creamos en el controlador HOME -->
    <div id="audios-list" style="padding-top: 10px">
        <!-- Aqui hacemos un IF ELSE para trabajar con la SEARCH. Si existe audios que coincidan con la busqueda entra en el bucle, sino me muestra una alerta -->
        @if(count($audios)>=1)

            <!-- Al FOREACH le paso el nombre de la variable que le paso desde el controlador a la vista ($audios) y que en cada interaccion me cree una variable que se llame $audio.-->
            @foreach($audios as $audio)
                <div class="audio-item col-md-9 pull-left panel panel-default">

                            <!--------PANEL-BODY ------------------------------------->
                            <div class="panel-body">

                            <!-- ----------DATOS-AUDIO --------->
                                <div class="data">
                                    <!-- Para que el titulo me lleve al audio tenemos que pararle el nombre de la ruta y el parametro del [audio_id] que estamos recorriendo en este preciso instante-->
                                    <h3 class="audio-title"><a href="{{route('detailAudio',['audio_id' => $audio ->id]) }}"> {{$audio->title}}</a></h3>
                                    <!-- Para q nos lleve al canal de usuario al hacer click en el nombre
                                        debemos porner el nombre de la ruta y el user_id que necesita
                                        que lo podemos conseguir del objeto AUDIO user_id-->
                                    <p><a href="{{route('channel',['user_id'=>$audio->user_id])}}"> {{$audio->user->name.' '.$audio->user->surname}}</a> | {{\FormatTime::LongTimeFilter($audio->created_at)}}</p>
                                </div>

                            <!-------------BOTONES-------------->
                            <!-- Si estamos identificados nos muestra los botones de accion. Pero que tambien corresponda con el usuario que agrego el audio. Entonces sacamos de USER el ID -->
                            @if(Auth::check()&& Auth::user()->id == $audio->user->id)
                                <a href="{{route('editAudio',['audio_id' => $audio->id]) }}" class="btn btn-warning">Editar</a>

                                <a href="{{route('detailAudio',['audio_id' => $audio ->id]) }}" class="btn btn-success">Ver</a>
                                <!---------------------------------------------------------------------------->
                                <!---------------------------OVERLAY------------------------------------------>
                                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                <!-- Lo primero que tengo es un boton que nos hace ancla al DIV de abajo con id="vidtorModal"
                                Hay que indicarle el ID del comentario para que no sean todos los mismos modals. Es decir para que cada ventanita y cada boton sea diferente. Sino me sale el mismo siempre ({{$audio->id}})-->
                                <a href="#victorModal{{$audio->id}}" role="button" class="btn btn-danger" data-toggle="modal">Eliminar</a>
      
                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="victorModal{{$audio->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                                </div>
                                            <div class="modal-body">
                                                <p>¿Seguro que quieres borrar este audio?</p>
                                                <p class="text-warning"><small>{{$audio->title}}</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <!-- Para poder borrar losc comentarios tengo que hacer un nuevo metodo en el controlador de comentarios. Le paso por parametro a la ruta el ID del comentario que deseo borrar--> 
                                                <a href="{{url('/delete-audio/'.$audio->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!---------------------------/OVERLAY---------------------------------------->
                            @endif
                            </div>
                            <!--------/PANEL-BODY ------------------------------------->
                        </div>
                    @endforeach
                <!-- EN el caso de que no hubieran audios que coincida con la busqueda que muestre una alerta-->
                @else
                    <div class="alert alert-warning"> No hay audios actualmente</div>
                @endif

                <!-- ----------PAGINACION -------------->
                <!-- Para pintar la paginacion utilizo el objeto $audios que tenemos del controlador y el metodo LINKS -->
                <!-- EL clear fix e s para evitar el overflow y que quede donde tien que ir el pagination-->
                <div class="clearfix"></div>
                {{$audios-> links()}}
            </div>


            