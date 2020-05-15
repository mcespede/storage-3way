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