@extends('layouts.app')
@section('content')
<table class="table table-hover">
    <thead>
     <th>Username</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
          <td>{{$user->name}} </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection