@extends('layouts.frontend.master')

@section('content')
    <!-- Header Section -->
    <header class="header"
        style="background: url('{{asset('assets/images/ibbu-1-1.jpg')}}') no-repeat center center;
        background-size: cover;">
        <div class="container">
            <h1 class="display-3">Organizational Structure</h1>
            {{-- <p class="lead">{{ $icdl_module->short_description }}.</p> --}}
        </div>
    </header>

    <!-- Module Details Section -->
    <section class="container-fluid my-5 py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-left">
                {{-- <h2 class="section-title mb-4 text-center">MANDATE</h2> --}}
                <div id="module-description">
                   

                    <div class="organogram">
                        <div class="level">
                            <div class="entity">ICDL Global</div>
                            <div class="arrow">↓</div>
                        </div>
                        <div class="level">
                            <div class="entity">ICDL Africa</div>
                            <div class="arrow">↓</div>
                        </div>
                        <div class="level">
                            <div class="entity">ICDL Local Office Provider (LOPs)</div>
                            <div class="arrow">↓</div>
                        </div>
                        <div class="level">
                            <div class="entity">Accredited Test Centers (ATCs)</div>
                        </div>
                    </div>

                    <style>
                        .organogram {
                            text-align: center;
                            font-family: Arial, sans-serif;
                        }
                        .level {
                            margin: 10px 0;
                        }
                        .entity {
                            font-weight: bold;
                        }
                        .arrow {
                            font-size: 24px;
                            line-height: 1;
                        }
                    </style>

                </div>
            </div>
        </div>
      
    </section>
   
@endsection
