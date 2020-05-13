@extends('layouts.mainTemplate')

@section('content')

<div class="panel panel-success col-md-10">
<div class="panel-heading">
  <h3>Contact form</h3>
</div>
<div class="panel-body">
  <form>
    <div class="form-group">

      <div class="panel panel-success">

        <div class="panel-body col-md-10">

            <label for="exampleInputEmail1">Name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <textarea type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
              
            </textarea> 
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </div>
        
      </div>


    
  </form>  
</div>


</div>

@endsection