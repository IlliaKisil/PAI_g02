@extends('layout')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  $(function(){
  var x = document.getElementById("history");
  $('button#showHistory').on('click',function(){ 
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    // $('#history').show();
  });
});
</script>

@endsection

<style>
.leftpic   {
  float: left; 
  width: 400px;
  margin-top: 2%
}
h2{
  float: center;
  margin-right: 10px;
  color: white;
  position: central;
  /* background: rgb(234, 149, 119); */
}
#card_number{
  position: absolute;
  top: 400px;
  left: 100px;
  
}

</style>

@section('main')
<main class="px-3">
  
  <img src="/images/RabbitBank-card-obvodka.png" class="leftpic" >
  <h2 сlass="card_name" style="margin-top: 5%">Rabbit Bank Universal</h3>
   
  <br>
  {{-- wyswietlenie numera i salda kartki --}}
  @foreach ($db as $card)
    <p size="5px" >Card number: {{$card->card_number}}</p>
    <p>Balance : {{$card->balance}}$</p>
  @endforeach
  
  
  <form action="/transfer">
    <button type="submit" class="btn btn-success btn-rounded">New Transaction</button>
  </form>
  
  <button id="showHistory" button type="button" class="btn btn-info btn-rounded">Show History</button>
  
  {{-- history --}}
  <div id="history" style="display:none">
    <div class="table-responsive mt-3">
      <table class="table table-dark table-borderless">
          <thead>
              <tr>
                  <th scope="col">Activity</th>
                  <th scope="col">Card</th>
                  <th scope="col" class="text-right">Amount</th>
                  <th scope="col">Date</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($history as $trans)
              @if($trans->from == $card->card_number)
                <tr>
                  <td scope="row"> <span class="fa fa-briefcase mr-1"></span>Withdraw</td>
                  <td scope="row"> <span class="fa fa-briefcase mr-1"></span>{{$trans->to}}</td>
                  <td scope="row" style="color: red"> <span class="fa fa-long-arrow-up mr-1"></span>-{{$trans->amount}}$</td>
                  <td class="text-muted">{{$trans->created_at}}</td>
                </tr>
              @endif
              @if($trans->to == $card->card_number)
              <tr>
                <td scope="row"> <span class="fa fa-briefcase mr-1"></span>Deposit</td>
                <td scope="row"> <span class="fa fa-briefcase mr-1"></span>{{$trans->from}}</td>
                <td scope="row" style="color: green"> <span class="fa fa-long-arrow-up mr-1"></span>+{{$trans->amount}}$</td>
                <td class="text-muted">{{$trans->created_at}}</td>
              </tr>
              @endif
              
            @endforeach
              
          </tbody>
      </table>
    </div>
  </div>
  
</main>
@endsection