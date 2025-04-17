@extends('layouts.frontend.master')

@section('content')
    <!-- Header Section -->
    <header class="header"
        style="background: url('{{asset('assets/images/LE_4.jpg')}}') no-repeat center center;
        background-size: cover;">
        <div class="container">
            <h1 class="display-3">Our Mandate</h1>
            {{-- <p class="lead">{{ $icdl_module->short_description }}.</p> --}}
        </div>
    </header>

    <!-- Module Details Section -->
    <section class="container-fluid my-5 py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-left">
                {{-- <h2 class="section-title mb-4 text-center">MANDATE</h2> --}}
                <div id="module-description">
                    <p class="lead mb-4 text-justify" style="color: #555; text-align: justify; line-height: 2.0em;">
                        The production of high quality and globally competitive human capital at internationally recognized competitive levels of university education, that will lead the process of socio-economic, political engineering of Niger state and Nigeria.
                    </p>
                </div>
            </div>
        </div>
      
    </section>
   
@endsection
