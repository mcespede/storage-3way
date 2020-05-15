@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/image/{{ $user->image }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
        </div>
    </div>
</div>

@endsection