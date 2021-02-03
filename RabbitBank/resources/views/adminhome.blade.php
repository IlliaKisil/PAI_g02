@extends('layouts.adminlayout')


@section('main')

  <form action="/admin/adduser">
    <button type="submit" style="margin-top: 5%; margin-bottom: 1%; margin-left: 1%" class="btn btn-info btn-rounded">+Add User</button>
  </form>
    <table class="table table-bordered" >
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Card number</th>
            <th scope="col">Balance</th>
            <th scope="col">IsAdmin</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($db as $user)
            <form method="post" action="/admin/processing">
                <tr>
                    @csrf
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->card_number}}</td>
                    <td><input name="balance" id="balance" type="double" size="6em" value="{{$user->balance}}"></td>
                    <td>{{$user->IsAdmin}}</td>
                    <td><button type="submit" class="btn btn-success">Save</button></td>
                    <input name="hidden_id" id="hidden_id" type="numeric" size="0em" value="{{$user->id}}" hidden>
                </tr>
            </form>
                
            @endforeach
      </table>
@endsection