@extends('layouts.frontend.master')

@section('content')
    <!-- Header Section -->
    <header class="header"
        style="background: url('{{ asset('assets/images/LE_4.jpg') }}') no-repeat center center;
        background-size: cover;">
        <div class="container">
            <h1 class="display-3">Contact us</h1>
            {{-- <p class="lead">{{ $icdl_module->short_description }}.</p> --}}
        </div>
    </header>

    <!-- Module Details Section -->
    <section class="container-fluid my-5 py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-left module-description">
                {{-- <h2 class="section-title mb-4 text-center">MANDATE</h2> --}}
                <div class="row">
                    <!-- Contact Information -->
                    <div class="col-md-6">
                        <div id="map" style="height: 400px; width: 100%;"></div>
                        <script>
                            function initMap() {
                                const location = {
                                    lat: 9.0674,
                                    lng: 6.5698
                                }; // Replace with your desired coordinates
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
                        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap">
                        </script>
                    </div>
                    <div class="col-md-6">
                        <h3>Address</h3>
                       
                        <p> <i class="fas fa-map-marker-alt text-success"></i>Minna Road, Lapai 911101, Nigeria</p>

                        <h3>Open Hours</h3>

                        <p><i class="fas fa-clock text-success"></i> Monday - Friday: 9:00 AM - 5:00 PM</p>
                        <p>Saturday: 10:00 AM - 2:00 PM</p>
                        <p>Sunday: Closed</p>

                        <h3>Support Email</h3>
                        <p><a href="mailto:info@example.com">info@ibbu.edu.ng</a></p>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-md-12">
                        <h3>Contact Form</h3>
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
        </div>

    </section>
@endsection

@push('page_scripts')
    <script type="text/javascript">
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
