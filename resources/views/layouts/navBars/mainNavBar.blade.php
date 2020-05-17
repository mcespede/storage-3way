@push('styles')
    <!--<link href="{{ asset('css/socialMediaIcons.css') }}" rel="stylesheet">-->
@endpush

<!--------------------------TOP-NAVIGATION-BAR-------------------------------->
<nav class="navbar navbar-default navbar-static-top" style="box-shadow: 0 0 10px 0 black;" >

<!--------------------------TOP-BAR---------------------------------------- -->
    <div class="container col-md-12 col-md-offset-1">
            
        <!--------------------------HEADER------------------------------------ -->
        <div class="navbar-header col-md-1">
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
                    
            <a class="navbar-brand" href="{{ url('/') }}">             
                <img src="https://i.pinimg.com/originals/1c/00/72/1c0072ede2933cd26dfbe3bdecd6784d.gif"     width="30" height="30" 
                    class="d-inline-block align-top" alt=""/>
            </a>

            <!-- -------------- /Branding Image ------------------->          
        </div>
        <!--------------------------/HEADER---------------------------------------- -->          
  <div class="navbar-header col-md-4">          
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{route('home')}}"><span class=" glyphicon glyphicon-off"></a></li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Proyectos
        <span class="caret"></span></a>

        <ul class="dropdown-menu">
          <li><a href="{{route('videos')}}"><span class=" glyphicon glyphicon-play-circle"> Videos</a></li>

          <li><a href="{{route('audios')}}"><span class=" glyphicon glyphicon-volume-up"> Audios</a></li>

          <li><a href="{{route('docs')}}"><span class=" glyphicon glyphicon-folder-open"> Archivos</a></li>
        </ul>
      </li>
      <li><a href="#">Sobre mí</a></li>
      <li><a href="{{url('contacto')}}">Contacto</a></li>
    </ul>
   </div>         
        <!-----------------SOCIAL-MEDIA ------------------------------------------------>
        <div class="col-md-3" >
            <ul class="nav navbar-nav">
                <a href="#" class="fa fa-facebook fa-2x" style="padding-top: 7px">&nbsp; &nbsp;</a>                 
                <a href="#" class="fa fa-twitter fa-2x">&nbsp; &nbsp;</a>                    
                <a href="#" class="fa fa-linkedin fa-2x">&nbsp; &nbsp;</a>                   
                <a href="#" class="fa fa-youtube fa-2x">&nbsp; &nbsp;</a>                    
                <a href="#" class="fa fa-instagram fa-2x">&nbsp; &nbsp;</a>                                       
            </ul> 
        </div>

        <!-----------------/Social-MEdia ------------------------------------------------>

        <!--------------------------LEFT-HEADER---------------------------------------- -->
        <div class=" col-md-5 collapse navbar-collapse" id="app-navbar-collapse">

            <!-- ----------- Right Side Of Navbar----------- -->
            <ul class="nav navbar-nav navbar-right">

                <!-- Authentication Links -->
                <!-- SI no estamos identificados nos muestra el login y registro -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"><span class=" glyphicon glyphicon-user"> Login</a></li>
                    <!--<li><a href="{{ route('register') }}">Register</a></li>-->

                <!-- SI  estamos identificados nos muestra la pagina de USUARIO -->
                @else
                            
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