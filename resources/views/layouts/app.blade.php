<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Con esto puedo agregar un tiulo individual a los tabs--->
    <title>MCA- @yield('title')</title>
<!------------------------------------------- -->
    <!---------------- Styles ---------->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Este es importante para que funciones los Glyphicons.Por algun motivo solo asi me funciona -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    

    <!-- Cargamos el archivo de CSS particular que tenemos dentro del storage en la carpeta CSS que creamos. Utilizo un URL y la ruta ruta donde tengo el ASSET -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}"/>

  <!-- Con este link cargamos la configuracion del bootstrap.min.css, con todos los defaults-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <!--Esto lo coloco aqui para poder hacer PUSH de styles o scrips individuales en las vistas
        Es super poderoso para poder conbinar estilos en las vistas
        La vista que los ocupe solo tiene que hacer el PUSH y la RUTA-->
            @stack('styles')
        @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!--------------------------------------- -->
</head>

<!------------------------------------------------------------------------------------- -->
<body>
    <!--------------------------MAIN---------------------------------------- -->
    <div id="app">
            @include('layouts.navBars.mainNavBar')
<!--------------------------TOP-TAB-MENU----------------------------------------->

<!-- Aqui creo un menu con tabs para reccorrer el contenido del main page-->

            <!-------------CONTAINER-WRAPPER----------------------->
            <!-- Esto va a mantener todo el contenido de los tabs junto
                 con el side maenu main ------------>
            <div class="container">
                <div class="row">

                    <div class="col-md-10">
                        <!--La directiva (section) define una sección de contenido, mientras que la directiva (yield) es usada para mostrar el contenido de una sección específica
                        Es decir aqui se va a mostra el contenido de la seccion CONTENT de cualquiera de mis paginas. Solo tengo que poner la etiqueta CONTENT y el codigo-->
                        @yield('tabs')
                        @yield('content')

                    </div>


                    <!----------------------------------------------------------->
                    <!---------------------SIDEBAR------------------------------->
                    <!----------------------------------------------------------->
                    <!--- Esto lo incluyo aqui porque se muestra en todas las vistas-->
                    <div class="col-md-2">
                        @yield('sideBar')
                    </div> 
                    <!----------------------------------------------------------->
                    <!---------------------SIDEBAR------------------------------->
                    <!----------------------------------------------------------->
                </div>
            </div>
            <!-------------/CONTAINER-WRAPPER----------------------->
<!--------------------------/TOP-TAB-MENU----------------------------------------->
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
        
        <footer class="col-md-8 col-md-offset-1">
            <hr/>
            Curso de preparacion de laravel Mauro Cespedes 2020
        </footer>
    </div>
    <!--------------------------/MAIN---------------------------------------- -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>