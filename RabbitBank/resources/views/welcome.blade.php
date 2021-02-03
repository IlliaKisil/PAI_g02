@extends('layout')

@section('main')
<main class="px-3">
  <h1>Keep your money in safe place.</h1>
  <p class="lead">Rabbit Bank is the nextgen bank for people who want increase their money in few months.</p>
  <p class="lead">
    <a href="{{ route('register') }}" class="btn btn-lg btn-secondary fw-bold border-white bg-white" style="margin-top: 1em;">Sign up</a>
  </p>
</main>
@endsection