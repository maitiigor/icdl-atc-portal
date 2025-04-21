<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ICDL Training Center - IBBU</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <!-- Navigation -->
    <section class="social-contact-us bg-black text-white py-3">
        <div class="container-fluid text-center">
            <div class="d-flex justify-content-end align-items-center px-4">
              {{-- <div>
                <p class="mb-0 me-3">Connect with us on Social Media</p>
             
              </div> --}}
                <div>
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <a href="https://www.facebook.com" target="_blank" class="text-white">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="text-white">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="text-white">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="mailto:info@ibbu.edu.ng" class="text-white">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{route('home')}}">
                <img src="{{ asset('images/logo.png') }}" alt="IBBU ICDL Logo"
                    style="height: 40px; margin-right: 10px;">
                <span><strong>IBBU ICDL Training Center</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
              $modules = \App\Models\ICDLModule::where("parent_id", null)->get();
            @endphp
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="About" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="About">
                            <li><a class="dropdown-item" href="{{ route('history') }}">History</a></li>
                            <li><a class="dropdown-item" href="{{ route('mandate') }}">Mandate</a></li>
                            <li><a class="dropdown-item" href="{{ route('cooperate-statement') }}">Coperate
                                    Statement</a></li>
                            <li><a class="dropdown-item" href="{{ route('organizational-structure') }}">Organizational
                                    Structure</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ModulesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         ICDL Modules
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ModulesDropdown">
                          @foreach ($modules as $module)
                            <li><a class="dropdown-item" href="{{ route('module.details', $module->id) }}">{{ $module->name }}</a></li>
                          @endforeach
                        </ul>
                      </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('show.contact-us') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 ICDL Training Center, IBBU University. All Rights Reserved.</p>
            <div class="partners mt-3">
                <p>Our Sponsors:</p>
                <ul class="list-inline">
                    <li class="list-inline-item" style="border-right: 1px solid #ccc; padding-right: 10px;">
                  
                       <a href="https://www.tetfund.gov.ng" class="nav-link" target="_blank">  <img src="{{asset('images/tetfund_logo.jpg')}}" alt=""> &nbsp; TETFund</a> 
                    </li>
                    <li class="list-inline-item"  style="border-right: 1px solid #ccc; padding-right: 10px;">
                       <a href="https://icdl.org" class="nav-link" target="_blank">    <img src="{{asset('images/icdl_logo.png')}}"  style="width: 50px; height: auto;" alt="">  &nbsp;  ICDL</a>
                    </li>
                 
                    <li class="list-inline-item"  style="border-right: 1px solid #ccc; padding-right: 10px;">
                        <a href="https://www.nuc.edu.ng" class="nav-link" target="_blank">  <img src="{{asset('images/nuc-header-new.png')}}" style="width: 50px; height: auto;"  alt="Nuc - Logo">  &nbsp;  NUC</a> 
                    </li>
             
                </ul>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper and Custom JS for smooth scroll -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    @stack('page_scripts')
</body>

</html>
