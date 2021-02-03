<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>RabbitBank</title>
    
    <!-- favicon -->
    <link rel="shortcut icon" href="/images/bunnylogo.ico" type="image/x-icon" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    @yield('scripts')

    <link rel="stylesheet" href="/css/cover.css">
        <style>
            
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
          }

          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
        </style>
  </head>
<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
          
          <h3 class="float-md-start mb-0">
            <img class="logo" src="/images/bunnylogo.png" width="35dp" height="auto" style="margin-bottom: 10%">
            Rabbit Bank
          </h3>
          
          @if (Route::has('login'))
            <nav class="nav nav-masthead justify-content-center float-md-end">
              @auth
                <a href="{{ url('/transfer') }}" class="nav-link" style="margin-top: 8%">Transfer</a>
                <a href="{{ url('/home') }}" class="nav-link" style="margin-top: 8%">Home</a>
                
                <!-- Authentication Links -->
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </div>
                
              @else
                <a href="{{ route('login') }}" class="nav-link" style="margin-top: 8%">Login</a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="nav-link" style="margin-top: 8%">Register</a>
                @endif
              @endauth
            </nav>
         @endif
        </div>
      </header>
      
      @yield('main')
      
      <footer class="mt-auto text-white-50">
        <p>Rabbit Bank, All rights reserved ©2021</p>
      </footer>
    </div>
  </body>
</html>

