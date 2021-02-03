@extends('layout')

@section('scripts')

<link rel="stylesheet" href="/css/signin.css">
@endsection

@section('main')
<main class="form-signin">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
      
      <label for="inputEmail" class="visually-hidden">Name</label>
      {{-- <input id="email" type="email" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
       
      <label for="inputEmail" class="visually-hidden">Email address</label>
      <input id="email" type="middle" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

      <label for="inputPassword" class="visually-hidden">Password</label>
      <input id="password"  style="border:none;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; margin-bottom: 0px;" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
      
      <label for="inputPassword" class="visually-hidden">Password confirm</label>
      <input id="password-confirm" style="border:none; border-top-left-radius: 0; border-top-right-radius: 0; margin-bottom: 10px;"  type="password" placeholder="Confirm password" class="form-control" name="password_confirmation" required autocomplete="new-password">

      @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
      @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
      @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
       
      
      <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Register') }}</button>
        
    </form>
  </main>
@endsection
