<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Admin</title>
</head>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/admin">RabbitBank Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="/admin">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/transactions">Transactions</a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
<body>
    <table class="table table-bordered" style="margin-top: 5%">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">User Id</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Amount</th>
            <th scope="col">Bank</th>
            <th scope="col">Code</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($db as $trans)
                <tr>
                    <th scope="row">{{$trans->id}}</th>
                    <td>{{$trans->user_id}}</td>
                    <td>{{$trans->from}}</td>
                    <td>{{$trans->to}}</td>
                    <td>{{$trans->amount}}</td>
                    <td>{{$trans->receiving_bank}}</td>
                    <td>{{$trans->code}}</td>
                    <td>{{$trans->confirmed}}</td>
                </tr>
                
            @endforeach
            
            
          
      </table>


</body>
</html>