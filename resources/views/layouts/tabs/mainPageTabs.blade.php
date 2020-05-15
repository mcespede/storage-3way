           <ul class="nav nav-tabs col-md-12">
                <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-home"></a></li>
                <li><a data-toggle="tab" href="#videos">Sobre mí</a></li>
                <li><a data-toggle="tab" href="#docs">Videos</a></li>
                <li><a data-toggle="tab" href="#docs">Articulos</a></li>
                <li><a data-toggle="tab" href="#docs">Contacto</a></li>

            </ul>


<!---------------TABS------------------------------>
                    <!-- todas las TABS estaran dentro de un COL-MD-10-->
                    <div class="tab-content col-md-8">

                        <!--------HOME---------->
                        <div id="home" class="tab-pane fade in active">
  
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