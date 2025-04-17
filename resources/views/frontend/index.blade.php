@extends('layouts.frontend.master')

@section('content')
    <!-- Hero Carousel -->
    <header id="hero" class="hero-carousel carousel slide" data-bs-ride="carousel" style="margin-top: 1px;">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('assets/images/LE_1.jpg');">
                <div class="hero-overlay"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-3">Welcome to the ICDL Training Center</h1>
                    <p class="lead">Empowering you with certified digital skills at IBBU University. Our programs are
                        designed to provide you with the knowledge and practical expertise needed to excel in today's
                        digital landscape. Whether you're a beginner or looking to enhance your skills, we have tailored
                        courses to meet your needs and help you achieve your career goals.</p>
                    <a href="#contact" class="btn btn-lg mt-3 btn-gradient-primary">Get Started</a>

                </div>
            </div>
            <div class="carousel-item" style="background-image: url('assets/images/LE_2.jpg');">
                <div class="hero-overlay"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-3">Advance Your Career</h1>
                    <p class="lead">Join our comprehensive training programs and achieve ICDL certification. Gain the
                        skills and confidence needed to thrive in the digital age, with courses tailored to meet the demands
                        of modern workplaces and industries.</p>
                    <a href="#contact" class="btn btn-lg mt-3 btn-gradient-primary">Get Started</a>
                </div>
            </div>
        <div class="carousel-item" style="background-image: url('assets/images/LE_3.jpg');">
            <div class="hero-overlay"></div>
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3">Learn at Your Own Pace</h1>
                <p class="lead">Our flexible learning options allow you to balance your studies with your personal and professional life. Start your journey to digital proficiency today.</p>
                <a href="#modules" class="btn btn-lg mt-3 btn-gradient-primary">Explore Modules</a>
            </div>
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </header>

    <!-- About Section (Plain background for clarity) -->
    <section id="about"
        style="background: linear-gradient(135deg, rgba(0, 128, 140,.9), rgba(34, 139, 34, 0.8)); color: #fff; padding: 60px 0;">
        <div class="container">
            <h2 class="section-title text-center text-white">About ICDL</h2>
            <p class="text-center">ICDL Foundation, a global influencer in digital literacy, has empowered over 17 million individuals worldwide through its flexible ‘Digital Skills Standard’ certification, bridging the digital divide and ensuring proficiency in the modern, technology-driven landscape.
                At its core, ICDL Foundation is a global force driving digital literacy and proficiency. Our mission is to enable proficient use of Information and Communication Technology (ICT) that empowers individuals, organisations and society, through the development, promotion, and delivery of quality certification programmes throughout the world. As a pivotal player in the digital skills landscape, ICDL Foundation is committed to bridging the digital divide and ensuring that individuals are well-equipped for the demands of the modern, technology-driven world.
                
                As a non-profit social enterprise, ICDL benefits from the unique support of experts from national computer societies and partners worldwide to develop vendor-independent standards that define the skills and knowledge required to use digital technology effectively. We work with education and training partners, local and regional authorities, national governments, international development organisations as well as public and private sector employers in all sectors, in the delivery of our.</p>
            <p class="text-center">We believe in continuous learning and adapting to emerging technologies, ensuring our
                students always receive
                current and comprehensive training.</p>
        </div>
    </section>

    <!-- ICDL Modules Section (Background image with overlay) -->
    <section id="modules" class="overlay"
        style="background: url('assets/images/pexels-mart-production-8472864.jpg') no-repeat center center; background-size: cover;">
        <div class="container">
            <h2 class="section-title text-white">ICDL Modules</h2>
            <div class="row g-4 justify-content-center">
                @foreach ($icdl_modules as $icdl_module)
                    <div class="col-md-3">
                        <div class="card module-card h-100">
                            <img src="{{ asset($icdl_module->image) }}" class="card-img-top" alt="{{ $icdl_module->name }}" style="height: 250px; object-fit: fill;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $icdl_module->name }}</h5>
                                <p class="card-text">{{ $icdl_module->short_description }}</p>
                                <a type="button" class="btn btn-primary btn-gradient-primary"
                                    href="{{ route('module.details', $icdl_module->id) }}">
                                    View More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-md-4">
                    <div class="card module-card h-100">
                        <img src="https://source.unsplash.com/400x250/?computer" class="card-img-top"
                            alt="Computer Essentials">
                        <div class="card-body">
                            <h5 class="card-title">Computer Essentials</h5>
                            <p class="card-text">Fundamentals of computer operations, troubleshooting, and effective
                                software use.</p>
                            <button type="button" class="btn btn-primary btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#moduleModal3">View More</button>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-md-4">
                    <div class="card module-card h-100">
                        <img src="https://source.unsplash.com/400x250/?collaboration" class="card-img-top"
                            alt="Online Collaboration">
                        <div class="card-body">
                            <h5 class="card-title">Online Collaboration</h5>
                            <p class="card-text">Techniques and tools for effective digital communication and remote
                                teamwork.</p>
                            <button type="button" class="btn btn-primary btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#moduleModal3">View More</button>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-md-4">
                    <div class="card module-card h-100">
                        <img src="https://source.unsplash.com/400x250/?cybersecurity" class="card-img-top"
                            alt="IT Security">
                        <div class="card-body">
                            <h5 class="card-title">IT Security</h5>
                            <p class="card-text">Best practices and strategies to safeguard digital information and systems.
                            </p>
                            <button type="button" class="btn btn-primary btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#moduleModal3">View More</button>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <!-- Button to view all modules -->
            <div class="mt-4">
                <a href="modules.html" class="btn btn-secondary btn-lg">View All Modules</a>
            </div> --}}
        </div>
    </section>

    @php
        $instructors = [
            [
                'name' => 'Mr. Bosun',
                'image' => asset('assets/images/testimonials/instructor1.jpeg'),
                'description' =>
                    'Portfolio Manager and IT Specialist with over 10 years of experience in digital education.',
            ],
            [
                'name' => 'Mr. Murtala',
                'image' => asset('assets/images/testimonials/instructor2.jpeg'),
                'description' => 'ATC Tester and IT Specialist with over 10 years of experience in digital education.',
            ],
            [
                'name' => 'Mr. Uba',
                'image' => asset('assets/images/testimonials/instructor3.jpeg'),
                'description' => 'ATC Tester and IT Specialist with over 10 years of experience in digital education.',
            ],
            [
                'name' => 'Mr Abdul',
                'image' => asset('assets/images/testimonials/instructor4.jpeg'),
                'description' => 'ATC Tester and IT Specialist with over 10 years of experience in digital education.',
            ],
        ];
    @endphp

    <!-- Meet Our Instructors Section (Plain background) -->
    <section id="instructors"
        style="background: linear-gradient(135deg, rgba(0, 128, 140,.9), rgba(34, 139, 34, 0.8)); color: #fff; padding: 60px 0;">
        <div class="container">
            <h2 class="section-title text-white">Meet Our Instructors</h2>
            <div class="row g-4 justify-content-center">

                @foreach ($instructors as $instructor)
                    <div class="col-md-3">
                        <div class="card instructor-card h-100 text-center">
                            <img src="{{ $instructor['image'] }}" class="card-img-top mx-auto"
                                alt="Instructor {{ $loop->iteration }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        {{-- <div class="card-body">
                                <h5 class="card-title">{{$instructor['name']}}</h5>
                                <p class="card-text">{{$instructor['description']}}</p>
                            </div> --}}
                    </div>
                @endforeach
                {{-- <div class="col-md-4">
                    <div class="card instructor-card h-100 text-center">
                        <img src="https://source.unsplash.com/400x400/?person,portrait"
                            class="card-img-top rounded-circle mx-auto mt-3" alt="Instructor 1"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Dr. Emily Carter</h5>
                            <p class="card-text">Expert in computer fundamentals and cybersecurity with over 15 years in
                                digital education.</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-md-4">
                    <div class="card instructor-card h-100 text-center">
                        <img src="https://source.unsplash.com/400x400/?person,profile"
                            class="card-img-top rounded-circle mx-auto mt-3" alt="Instructor 2"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Mr. Jonathan Lee</h5>
                            <p class="card-text">Specialist in online collaboration and remote working strategies with
                                practical industry insights.</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-md-4">
                    <div class="card instructor-card h-100 text-center">
                        <img src="https://source.unsplash.com/400x400/?person,smile"
                            class="card-img-top rounded-circle mx-auto mt-3" alt="Instructor 3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Ms. Sophia Ramirez</h5>
                            <p class="card-text">Focused on IT security and digital ethics, combining academic rigor with
                                real-world experience.</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- History Section (Background image with overlay) -->
    <section id="history" class="overlay"
        style="background: url('assets/images/ibbu-1-1.jpg') no-repeat center center; background-size: cover;">
        <div class="container">
            <h2 class="section-title text-white">About US</h2>
            <p>From humble beginnings to a state-of-the-art facility, our training center has grown into a beacon of digital
                excellence. In collaboration with ICDL, we have continually evolved our curriculum to meet
                industry demands, ensuring our students remain at the forefront of digital innovation.</p>
            <p>Our legacy is built on a commitment to quality education, continuous improvement, and the success of every
                student who walks through our doors.</p>
        </div>
    </section>

    @php
        $testimonial_assets = [
            asset('assets/images/testimonials/testimonia_1.jpeg'),
            asset('assets/images/testimonials/testimonia_2.jpeg'),
            asset('assets/images/testimonials/testimonia_3.jpeg'),
            asset('assets/images/testimonials/testimonia_4.jpeg'),
        ];
    @endphp

    <!-- Testimonials Section (Plain background) -->
    <section id="testimonials"
        style="background: linear-gradient(135deg, rgba(0, 128, 140,.9), rgba(34, 139, 34, 0.8)); color: #fff; padding: 60px 0;">
        <div class="container">
            <h2 class="section-title text-white">Testimonials</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($testimonial_assets as $idx => $testimonial_asset)
                        <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-8 ">
                                    <div class="row">
                                        <div class="col-md-12 testimonial">
                                            <img src="{{ $testimonial_asset }}" alt="Testimonial {{ $idx }}"
                                                class="img-fluid"
                                                style="max-height: 400px; width: auto; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8 testimonial">
                                <p>“This training center has transformed my career. The expert guidance and practical
                                    approach were exactly what I needed in today’s digital world.”</p>
                                <h6 class="text-end">- John Doe</h6>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8 testimonial">
                                <p>“A game-changer for digital education. The courses are well-structured and the
                                    instructors are truly inspiring.”</p>
                                <h6 class="text-end">- Jane Smith</h6>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Section (Plain background with soft contrast) -->
    <section id="contact"
        style="background: linear-gradient(135deg, rgba(5, 54, 71, 0.9), rgba(9, 10, 10, 0.9)); color: #f0f0f0;">
        <div class="container">
            <h2 class="section-title text-white">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                    <script>
                        function initMap() {
                            const location = { lat: 9.615, lng: 6.556 }; // Replace with your desired coordinates
                            const map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 15,
                                center: location,
                            });
                            const marker = new google.maps.Marker({
                                position: location,
                                map: map,
                            });
                        }
                    </script>
                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_demoKeyForTesting&callback=initMap">
                    </script>
                </div>
                <div class="col-md-8">
                    <form>
                        <div id="div-contact-modal-error" class="alert alert-danger" role="alert"></div>
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter your name"
                                required />
                        </div>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email"
                                required />
                        </div>
                        <div class="mb-3 text-start">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea id="message" class="form-control" rows="5" placeholder="Type your message" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="submitContact"
                                class="btn btn-primary btn-gradient-primary btn-lg">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page_scripts')
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a.nav-link').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').replace(location.origin, '');

                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        
        
        $(document).ready(function() {
            $('#div-contact-modal-error').hide();

            $('#submitContact').on('click', function(e) {
                e.preventDefault();
                // Here you can add your form submission logic
                let endPointUrl = "{{ route('contact-us') }}";

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('_method', 'POST');

                $('#div-contact-modal-error').html('');

                formData.append('name', $('#name').val());
                formData.append('email', $('#email').val());
                formData.append('message', $('#message').val());
             

                $.ajax({
                    url: endPointUrl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(result) {
                        if (result.errors) {
                            console.log(result.errors)
                            result.errors.forEach(function(error) {
                                $('#div-contact-modal-error').append(
                                    '<li>' + error + '</li>');
                            });
                            $('#div-contact-modal-error').show('');
                            // Swal.fire("Error",
                            //     "Oops an error occurred. Please try again.",
                            //     "error");
                        } else {
                            $('#div-contact-modal-error').hide('');
                            Swal.fire({
                                title: "Submitted",
                                text: "Your Message was sent successfully.",
                                icon: "success",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            }).then((result) => {
                                location.reload(true);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(xhr);

                        if (xhr.status == 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#div-contact-modal-error').append(
                                    '<li>' + value[0] + '</li>');
                            });
                        } else {
                            $('#div-contact-modal-error').append(
                                '<li>Oops an error occurred. Please try again.</li>');
                        }
                        $('#div-contact-modal-error').show('');

                    }
                });
            });

        })
    </script>
@endpush
