@extends('layouts.documentosTemplate')

@section('title','Archivos')

@section('sideBar')
    @include('layouts.sideBars.mainSideBar')
@endsection

@section('content')
    <!-- Ahora vamos a recorrer todos los docs que existen , utilizando el metodo PAGINATE que creamos en el controlador HOME -->
    <div id="videos-list" style="padding-top: 10px">
        <!-- Aqui hacemos un IF ELSE para trabajar con la SEARCH. Si existe docs que coincidan con la busqueda entra en el bucle, sino me muestra una alerta -->
        @if(count($docs)>=1)

            <!-- Al FOREACH le paso el nombre de la variable que le paso desde el controlador a la vista ($docs) y que en cada interaccion me cree una variable que se llame $doc.-->
            @foreach($docs as $doc)
                <div class="docs-list col-md-9 pull-left panel panel-default">

                    <!--------PANEL-BODY ------------------------------------->
                    <div class="panel-body">

                        <!-- ----------DATOS-DOC --------->
                        <div class="data">
                            <!-- Para que el titulo me lleve al doc tenemos que pararle el nombre de la ruta y el parametro del [dos_id] que estamos recorriendo en este preciso instante-->
                            <h3 class="doc-title"><a href="{{route('detailDoc',['doc_id' => $doc ->id]) }}"> {{$doc->title}}</a></h3>
                            <!-- Para q nos lleve al canal de usuario al hacer click en el nombre
                            debemos porner el nombre de la ruta y el user_id que necesita
                            que lo podemos conseguir del objeto doc user_id-->
                            <p><a href="{{route('channel',['user_id'=>$doc->user_id])}}"> {{$doc->user->name.' '.$doc->user->surname}}</a> | {{\FormatTime::LongTimeFilter($doc->created_at)}}</p>
                                </div>

                            <!-------------BOTONES-------------->
                            <!-- Si estamos identificados nos muestra los botones de accion. Pero que tambien corresponda con el usuario que agrego el doc. Entonces sacamos de USER el ID -->
                            @if(Auth::check()&& Auth::user()->id == $doc->user->id)

                                <a href="{{route('detailDoc',['doc_id' => $doc ->id]) }}" class="btn btn-success"><span class="glyphicon glyphicon-play-circle"></a>

                                <a href="{{route('editDoc',['doc_id' => $doc ->id]) }}" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></a>

                                
                                <!---------------------------------------------------------------------------->
                                <!---------------------------OVERLAY------------------------------------------>
                                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                <!-- Lo primero que tengo es un boton que nos hace ancla al DIV de abajo con id="vidtorModal"
                                Hay que indicarle el ID del comentario para que no sean todos los mismos modals. Es decir para que cada ventanita y cada boton sea diferente. Sino me sale el mismo siempre ({{$doc->id}})-->
                                <a href="#victorModal{{$doc->id}}" role="button" class="btn btn-danger" data-toggle="modal"><span class="glyphicon glyphicon-trash"></a>
      
                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="victorModal{{$doc->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                                </div>
                                            <div class="modal-body">
                                                <p>¿Seguro que quieres borrar este documento?</p>
                                                <p class="text-warning"><small>{{$doc->title}}</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <!-- Para poder borrar losc comentarios tengo que hacer un nuevo metodo en el controlador de comentarios. Le paso por parametro a la ruta el ID del comentario que deseo borrar--> 
                                                <a href="{{url('/delete-doc/'.$doc->id)}}" type="button" class="btn btn-danger">Eliminar</a>
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
                <!-- EN el caso de que no hubieran docs que coincida con la busqueda que muestre una alerta-->
        @else
            <div class="alert alert-warning"> No hay documentos actualmente</div>
        @endif

                <!-- ----------PAGINACION -------------->
                <!-- Para pintar la paginacion utilizo el objeto $docs que tenemos del controlador y el metodo LINKS -->
                <!-- EL clear fix e s para evitar el overflow y que quede donde tien que ir el pagination-->
                <div class="clearfix"></div>
                {{$docs-> links()}}
            </div>

@endsection
            