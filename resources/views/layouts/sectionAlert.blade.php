        <!----------------------------------------->
        <div class="container">
            <!-- Mostrar el mensaje cuando creo un nuevo video. Compruebo si existe mensaje-->

            @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <!----------------------------------------->