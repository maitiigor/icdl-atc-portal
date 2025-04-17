<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ICDL Training Center - IBBU</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body>
  <!-- Navigation -->
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('images/logo.png') }}" alt="IBBU ICDL Logo" style="height: 40px; margin-right: 10px;">
      <span><strong>IBBU ICDL Training Center</strong></span>
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{route('home')}}#hero">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('home')}}#modules">ICDL Modules</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="About" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              About Us
            </a>
              <ul class="dropdown-menu" aria-labelledby="About">
                <li><a class="dropdown-item" href="{{route('history')}}">History</a></li>
                <li><a class="dropdown-item" href="{{route('mandate')}}">Mandate</a></li>
                <li><a class="dropdown-item" href="{{route('cooperate-statement')}}">Coperate Statement</a></li>
                <li><a class="dropdown-item" href="{{route('organizational-structure')}}">Organizational Structure</a></li>
              </ul>
            </li>
          <li class="nav-item"><a class="nav-link" href="{{route('home')}}#contact">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2025 ICDL Training Center, IBBU University. All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle with Popper and Custom JS for smooth scroll -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
  @stack('page_scripts')
</body>
</html>
