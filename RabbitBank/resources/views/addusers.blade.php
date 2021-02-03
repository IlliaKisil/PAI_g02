@extends('layouts.adminlayout')

@section('main')

    <form action="/admin/addinguser" method="post" style="margin-top: 5%">
        @csrf
        <div class="form-group mx-sm-3 mb-2" style="width : 20%;">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" style="margin-top: 2%" autofocus>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email address" style="margin-top: 2%">
           
            <input type="text"  class="form-control" id="password" name="password" placeholder="Password" style="margin-top: 2%">
            <button type="submit" style="margin-top: 5%; margin-bottom: 1%; margin-left: 1%" class="btn btn-info btn-rounded">Add User</button>
        </div>
        
    </form>
@endsection