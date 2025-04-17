@extends('layouts.frontend.master')

@section('content')
    <!-- Header Section -->
    <header class="header"
        style="background: url('{{ asset($icdl_module->image) }}') no-repeat center center;
        background-size: cover;">
        <div class="container">
            <h1 class="display-3">{{ $icdl_module->name }}</h1>
            <p class="lead">{{ $icdl_module->short_description }}.</p>
        </div>
    </header>

    <!-- Module Details Section -->
    <section class="container-fluid my-5 py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-left">
                <h2 class="section-title mb-4 text-center">Module Details</h2>
                <div id="module-description">
                    <p class="lead mb-4 text-justify" style="color: #555; text-align: justify;">
                        {!! $icdl_module->full_description !!}
                    </p>
                </div>
            </div>
        </div>
        @php
            $resources = $icdl_module->resources;
        @endphp
        @if($resources->count())
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <p class="h3 section-title "> Module Resources </p>
                    <div class="">
                        <ul>
                            @foreach ($resources as $resource)
                                <li class="d-inline-flex">
                                    <div class="d-flex gap-2">
                                        <a href="{{ asset($resource->file_path) }}" style="text-decoration: underline"
                                            download>{{ $resource->resource_name }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div></div>
        <div class="row mt-4">
            <div class="col text-center">
                <!-- Apply Now Button triggers modal -->
                <button type="button" class="btn btn-primary btn-gradient-primary btn-lg" id="btn-create-application-modal"
                    data-bs-toggle="modal" data-bs-target="#applyModal">
                    Apply Now
                </button>
            </div>
        </div>
    </section>

    <!-- Other Modules Section -->
    @if (count($relationModules) > 0)
        <section class="container my-5">
            <h2 class="section-title">Other Modules</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 other-modules">

                <!-- Module: Online Collaboration -->
                @foreach ($relationModules as $relationModule)
                    <div class="col-md-4">
                        <div class="card module-card h-100">
                            <img src="{{ asset($relationModule->image) }}" class="card-img-top" alt="{{ $relationModule->name }}"
                                style="height: 250px; object-fit: fill;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $relationModule->name }}</h5>
                                <p class="card-text">{{ $relationModule->short_description }}</p>
                                <a type="button" class="btn btn-primary btn-gradient-primary"
                                    href="{{ route('module.details', $relationModule->id) }}">
                                    View More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <!-- Module: IT Security -->
            <div class="col">
                <div class="card h-100" onclick="window.location.href='it-security.html';">
                    <img src="https://source.unsplash.com/400x250/?cybersecurity" class="card-img-top" alt="IT Security">
                    <div class="card-body">
                        <h5 class="card-title">IT Security</h5>
                        <p class="card-text">Learn best practices to protect digital information and systems.</p>
                    </div>
                </div>
            </div>
            <!-- You can add more module cards here --> --}}
            </div>
        </section>
    @endif

    <!-- Apply Now Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">{{ $icdl_module->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div id="div-application-modal-error" class="alert alert-danger" role="alert"></div>

                        <div class="mb-3">
                            <label for="applicantName" class="form-label">Name</label>
                            <input type="text" id="applicantName" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="applicantEmail" class="form-label">Email</label>
                            <input type="email" id="applicantEmail" class="form-control" placeholder="Your Email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="applicantPhone" class="form-label">Phone Number</label>
                            <input type="tel" id="applicantPhone" class="form-control" placeholder="Your Phone Number"
                                required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="submitApplication" class="btn btn-gradient-primary btn-lg">Submit
                                Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn-create-application-modal').on('click', function(event) {
                // Reset the form fields

                $('#applicantName').val('');
                $('#applicantEmail').val('');
                $('#applicantPhone').val('');
                $('#div-application-modal-error').hide();
                $('#div-application-modal-error').html('');

            });

            // Handle Apply Now button click
            $('#submitApplication').on('click', function(e) {
                e.preventDefault();
                // Here you can add your form submission logic


                let endPointUrl = "{{ route('module.apply', '') }}";

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('_method', 'POST');

                $('#div-application-modal-error').html('');

                formData.append('name', $('#applicantName').val());
                formData.append('email', $('#applicantEmail').val());
                formData.append('telephone', $('#applicantPhone').val());
                formData.append('icdl_module_id', "{{ $icdl_module->id }}");

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
                                $('#div-application-modal-error').append(
                                    '<li>' + error + '</li>');
                            });
                            $('#div-application-modal-error').show('');
                            // Swal.fire("Error",
                            //     "Oops an error occurred. Please try again.",
                            //     "error");
                        } else {
                            $('#div-application-modal-error').hide('');
                            Swal.fire({
                                title: "Submitted",
                                text: "Application submitted successfully. Your Intrest in  (({{ $icdl_module->name }})) has been recorded. You will be contacted soon.",
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
                                $('#div-application-modal-error').append(
                                    '<li>' + value[0] + '</li>');
                            });
                        } else {
                            $('#div-application-modal-error').append(
                                '<li>Oops an error occurred. Please try again.</li>');
                        }
                        $('#div-application-modal-error').show('');

                    }
                });
            });

        });
    </script>
@endpush
