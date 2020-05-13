<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Videos Laravel') }}</title>
<!------------------------------------------- -->
    <!---------------- Styles ---------->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Este es importante para que funciones los Glyphicons.Por algun motivo solo asi me funciona -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- Cargamos el archivo de CSS particular que tenemos dentro del storage en la carpeta CSS que creamos. Utilizo un URL y la ruta ruta donde tengo el ASSET -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}"/>

  <!-- Con este link cargamos la configuracion del bootstrap.min.css, con todos los defaults-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!--------------------------------------- -->
</head>

<!------------------------------------------------------------------------------------- -->
<body>
    <!--------------------------MAIN---------------------------------------- -->
    <div id="app">
<!--------------------------TOP-NAVIGATION-BAR----------------------------------------->
        <nav class="navbar navbar-default navbar-static-top">

            <!--------------------------TOP-BAR---------------------------------------- -->
            <div class="container">

                <!--------------------------HEADER---------------------------------------- -->
                <div class="navbar-header">

                    <!-- --------------Collapsed Hamburger ---------------->
                    <!-- Esto es el menu responsive -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- --------------/Collapsed Hamburger --------------->

                    <!-- -------------- Branding Image -------------------->
                    <!-- Esto es el nombre que nos lleva a HOME-->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Videos Laravel
                    </a>
                    <!-- -------------- /Branding Image ------------------->
                </div>
                <!--------------------------/HEADER---------------------------------------- -->

                <!------------------------------------------------------------------------- -->

                <!--------------------------LEFT-HEADER---------------------------------------- -->
                <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- ----------- Left Side Of Navbar ----------- -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- -------------SEARCH-BAR ------------------>
                    <!-- Aqui añadimos la ruta de buscar para funcione con el controlador.-->
                    <form class="navbar-form navbar-left" role="search" action="{{url('/buscar')}}">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Que quieres ver?" name="search">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </form>
                    <!-- -------------/SEARCH-BAR ------------------>
                    
            <!-- ----------- /Left Side Of Navbar ----------- -->

                    <!-- -------------MENU-CENTRAL ------------------>
                    <!--Este menu esta optimizado para colapsar de buan forma en moviles-->
                    <div>
                      <ul class="nav navbar-nav">
                        <li ><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-envelope"></span></a></li>
                        <li><a href="#">Page 2</a></li>
                      </ul>

                    </div>
                    <!-- -------------/MENU-CENTRAL ------------------>

            <!-- ----------- Right Side Of Navbar----------- -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        <!-- SI no estamos identificados nos muestra el login y registro -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>

                        <!-- SI  estamos identificados nos muestra la pagina de USUARIO -->
                        @else

                            <!-- NEW-VIDEO -->
                            <!-- Es usuario identificado puede subir nuevos videos -->
                            <li>
                                <a href="{{route('createVideo')}}"> <span class="glyphicon glyphicon-circle-arrow-up">-</span>Subir Video</a>
                            </li>
                            <!-- /NEW-VIDEO -->

                            
                            <!-- Agregamos para que se vea el Alias registrado-->
                            <!-- Tendre un dropdown con el nombre del USUARIO identificado -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->alias }}
                                </a>

                                <!-- ---------/OPCIONES-MENU --------------->
                                <ul class="dropdown-menu" role="menu">
                                    <li>

                                        <!-- --------- 1-LOGOUT --------------->
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <!-- --------- /1-LOGOUT --------------->
                                         <!-- Para que el titulo me lleve al perfil tenemos que pasarle el nombre de la ruta y el parametro del [id] que estamos recorriendo en este preciso instante-->
                                    </li>
                                    <li>
                                        <!-- Como estamos en la plantilla principal el llamado a las propiedades del ojeto user se hacen diferente. So se puede utilizar el objeto userProfile que creamos en el controlador porque no funciona.Tenemos que cojer las propiedades del Auth::user -->
                                        <a href="{{route('editProfile',['id' =>Auth::user()->id]) }}">Perfil</a>
                                    </li>
                                </ul>
                                <!-- ---------/OPCIONES-MENU --------------->
                            </li>

                            <!------------CONFIGURACION -------- -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span>
                                </a>

                                <!-- ---------/OPCIONES-MENU --------------->
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""> Eins </a> 
                                    </li>
                                    <li>
                                        <a href=""> Zwei </a>
                                    </li>
                                </ul>
                                <!-- ---------/OPCIONES-MENU --------------->
                            </li>
                            <!------------/CONFIGURACION -------- -->
                        @endif
                    </ul>
            <!-- ----------- /Right Side Of Navbar----------- -->
                </div>
                <!--------------------------/LEFT-HEADER---------------------------------------- -->

            </div>
            <!--------------------------TOP-BAR---------------------------------------- -->
        </nav>
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
<!--------------------------TOP-TAB-MENU----------------------------------------->

<!-- Aqui creo un menu con tabs para reccorrer el contenido del main page-->


           <ul class="nav nav-tabs col-md-10 col-md-offset-1">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#videos">Videos</a></li>
                <li><a data-toggle="tab" href="#docs">Docs</a></li>

            </ul>
            <!-------------CONTAINER-WRAPPER----------------------->
            <!-- Esto va a mantener todo el contenido de los tabs junto
                 con el side maenu main ------------>
            <div class="container">
                <div class="row">

                    <!---------------TABS------------------------------>
                    <!-- todas las TABS estaran dentro de un COL-MD-10-->
                    <div class="tab-content col-md-8">

                        <!--------HOME---------->
                        <div id="home" class="tab-pane fade in active">

                            <h3></h3>
                            @yield('content')
                        </div>

                        <!--------Videos---------->
                        <div id="videos" class="tab-pane fade">  
                            <div class="row">
                                <!-- -------------SEARCH-BAR ------------------>
                                <!-- Aqui añadimos la ruta de buscar para funcione con el controlador.-->
                                <form class="navbar-form navbar-left" role="search" action="{{url('/buscar')}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Que quieres ver?" name="search">
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </form>
                                <!-- -------------/SEARCH-BAR ------------------>                                
                            </div>

                            <div class="row">
                                 
                            </div>

                        </div>

                        <!--------DOCS---------->
                        <div id="docs" class="tab-pane fade">    

                        </div>
                    
                    </div>   
                    <!---------------TABS------------------------------>

                    <!--- Esto lo incluyo aqui porque se muestra en todas las vistas-->
                    <div class="col-md-4">
                            @include('layouts.mainSideMenu')
                    </div> 

                </div>
            </div>
            <!-------------/CONTAINER-WRAPPER----------------------->
<!--------------------------/TOP-TAB-MENU----------------------------------------->
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------->
        
        <footer class="col-md-10 col-md-offset-1">
            <hr/>
            Curso de preparacion de laravel Mauro Cespedes 2020
        </footer>
    </div>
    <!--------------------------/MAIN---------------------------------------- -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>