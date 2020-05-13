
<!--- Esta pagina contiene toda la informacion sobre los video
      La invocamos desde la plantilla main y muestra toda la info de los videos
      Es para manejar el tab de videos -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!----------------------------------------->
                <!-- Mostrar el mensaje cuando creo un nuevo video. Compruebo si existe mensaje-->

                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
            <!-----------------------------------------> 
        </div>

        <!----------------VIDEO-LIST----------------------->
        <div class="col-md-8">

           <!-- Incluimos la vista para que de una muestre todos los videos--> 
           @include('video.videosList') 

           <!-- Utilizamos el YIELD para que incluya los contenidos de cada pagina-->
           
        </div>
        
        <!----------------/VIDEO-LIST----------------------->
        
    </div>
</div>

