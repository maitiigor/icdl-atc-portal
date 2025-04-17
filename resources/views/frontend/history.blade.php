@extends('layouts.frontend.master')

@section('content')
    <!-- Header Section -->
    <header class="header"
        style="background: url('{{asset('assets/images/LE_4.jpg')}}') no-repeat center center;
        background-size: cover;">
        <div class="container">
            <h1 class="display-3">Our History</h1>
            {{-- <p class="lead">{{ $icdl_module->short_description }}.</p> --}}
        </div>
    </header>

    <!-- Module Details Section -->
    <section class="container-fluid my-5 py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-left">
                <h2 class="section-title mb-4 text-center">HISTORY OF TETFUND, ICDL IN IBB UNIVERSITY</h2>
                <div id="module-description">
                    <p class="lead mb-4 text-justify" style="color: #555; text-align: justify; line-height: 2.0em;">
                        TETFUND (Tertiary Education Trust Fund) is a federal government agency in Nigeria that provides funding for infrastructure development, research, and publications in the country's public tertiary institutions. IBB University (Ibrahim Badamasi Babangida University) is one of the beneficiaries of TETFUND's interventions.
                        One of the interventions that TETFUND has provided to IBB University is the ICDL (International Computer Driving License) program. ICDL is a globally recognized computer proficiency certification program that aims to help individuals and organizations develop their digital skills and literacy.
                        Here is a brief history of TETFUND's involvement in ICDL in IBB University:
                        Introduction of ICDL in IBB University: TETFUND introduced the ICDL program in IBB University in 2012 as part of its efforts to promote the development of digital skills among students and staff.
                        Funding for ICDL: TETFUND provided funding for the implementation of the ICDL program in IBB University, including the cost of training, certification, and infrastructure development.
                        Training and Certification: The ICDL program in IBB University involves training and certification in various computer skills, including Microsoft Office, multimedia, and internet and email.
                        Beneficiaries of ICDL: The ICDL program in IBB University is open to all students and staff in the university, as well as members of the broader community.
                        Impact of ICDL: The ICDL program has helped to improve the digital skills and literacy of thousands of individuals in IBB University and the surrounding community, enabling them to participate more effectively in the digital economy.
                        Overall, TETFUND's involvement in the ICDL program in IBB University has helped to promote the development of digital skills and literacy in the university and the broader community. The program has provided opportunities for individuals to acquire new skills and certifications, enhancing their employability and competitiveness in the digital economy.
                    </p>
                </div>
            </div>
        </div>
      
    </section>
   
@endsection
