@extends('layout')



@section('main')
  <h2>Transfer</h2>
  
  @if($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
  @endif

  <form method="post" action="/transfer/confirming">
        @csrf
        <div class="col-xs-4">
            <select name="selectedCard" id="selectedCard" class="form-select form-select-lg mb-1" >
                <option selected="selected">From: {{$db[0]->card_number}} - {{$db[0]->balance}}$</option>
            </select>
            <br><br>
            <input type="text" name="recipient_card_number" id="recipient_card_number" placeholder="Recipient Card number" class="form-control"><br>
            <input type="double" name="amount" id="amount" placeholder="Amount" class="form-control">
            <button type="submit" class="btn btn-success btn-rounded" style="margin-top: 15px; width: 100%;">Transfer!</button>
        </div>
    </form>
    
@endsection

