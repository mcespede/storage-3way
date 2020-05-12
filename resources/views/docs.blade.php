
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

        <div class="col-md-4">
          @include('documents.sideMenuDocs')
        </div>

    </div>

</div>