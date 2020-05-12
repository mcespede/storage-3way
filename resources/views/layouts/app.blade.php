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
                                <a href="{{route('createVideo')}}"> Subir Video</a>
                            </li>
                            <!-- /NEW-VIDEO -->

                            <!-- Tendre un dropdown con el nombre del USUARIO identificado -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <!-- Agregamos para que se vea el Alias registrado-->
                                    {{ Auth::user()->alias }} <span class="caret"></span>
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

                                        <!-- --------- 2-USER-ACCOUNT --------------->

                                        <!-- --------- /2-OPCION --------------->
                                    </li>
                                </ul>
                                <!-- ---------/OPCIONES-MENU --------------->
                            </li>
                        @endif
                    </ul>
            <!-- ----------- /Right Side Of Navbar----------- -->
                </div>
                <!--------------------------/LEFT-HEADER---------------------------------------- -->

            </div>
            <!--------------------------TOP-BAR---------------------------------------- -->
        </nav>
<!--------------------------/TOP-NAVIGATION-BAR----------------------------------------->

<!--------------------------TOP-TAB-MENU----------------------------------------->
        <ul class="nav nav-tabs col-md-10 col-md-offset-1">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Videos</a></li>
            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
          </ul>

          <div class="tab-content col-md-10 col-md-offset-1">
            <div id="home" class="tab-pane fade in active">
              <h3></h3>
                @yield('content')
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3></h3>
                @yield('content')
            </div>
            <div id="menu2" class="tab-pane fade">
              <h3>Menu 2</h3>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
              <h3>Menu 3</h3>
              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
          </div>
<!--------------------------/TOP-TAB-MENU----------------------------------------->
        
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
