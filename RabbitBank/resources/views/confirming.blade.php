@extends('layout')

@section('main')

@if (!isset($data))
<script>
  window.location.replace("/transfer");
</script>  
@endif


@if($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
@endif
  
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal" style="color: black">Transfer</h4>
      </div>
      <div class="card-body">
        {{-- <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1> --}}
        <ul class="list-unstyled mt-3 mb-4" style="color: rgb(250, 0, 0)">
          <li>{{$data['selectedCard']}}</li>
          <li>To: {{$data['recipient_card_number']}}</li>
          <li>Bank name: {{$bankName}}</li>
          <li>Amount: {{$data['amount']}}$</li>
        </ul>
        <form method="post" action="/transfer/confirming/success">
          @csrf
          <input type="number" name="codeguard" id="codeguard" placeholder="Code from Mail" class="form-control">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" style="background-color: green">Confirm✓</button>
          </div>
        <form>
      </div>
    </div>
</div>
@endsection
