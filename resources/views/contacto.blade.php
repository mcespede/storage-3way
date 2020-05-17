@extends('layouts.app')

@section('content')

<div class="panel panel-success col-md-10" style="padding: 10px">
<div class="panel-heading">
  <h3>Contact form</h3>
</div>
<div class="panel-body">
  <form>
    <div class="form-group">

      <div class="panel panel-success">

        <div class="panel-body col-md-10">

            <label for="exampleInputEmail1">Nombre</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escribe tu nombre">
            <small id="emailHelp" class="form-text text-muted">Nunca voy a compartir tu información de contacto con terceros.</small>
          
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Escribe tu E-mail">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Escribe tu mensaje para mí</label>
            <textarea type="text" class="form-control" id="exampleInputPassword1" placeholder="Mensaje">
              
            </textarea> 
          </div>

          <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </div>
        
      </div>


    
  </form>  
</div>


</div>

@endsection