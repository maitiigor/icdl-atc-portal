@extends('layouts.app')
@section('title')
    @lang('translation.Profile')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="profile-user"></div>
        </div>
    </div>

    <div class="row">
        <div class="profile-content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="d-flex mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xxl me-3">
                                                <img src="@if ($current_user->avatar != '') {{ URL::asset('images/' . $current_user->avatar) }}@else{{ URL::asset('assets/images/users/avatar-1.png') }} @endif"
                                                    alt="profile-image"
                                                    class="img-fluid rounded-circle d-block img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <div class="row my-2">
                                                    <div class="col-sm-3 my-2">
                                                        <h5 class="card-text"> <strong> Name: </strong> </h5>
                                                    </div>
                                                    <div class="col-sm-9 my-2">

                                                        <h5 class="card-text"> {{ $current_user->name }} </h5>
                                                    </div>
                                                    <div class="col-sm-3 my-2">
                                                        <h5 class="card-text"> <strong> Email: </strong> </h5>
                                                    </div>
                                                    <div class="col-sm-9 my-2">
                                                        <h5 class="card-text"> {{ $current_user->email }} </h5>
                                                    </div>
                                                    <div class="col-sm-3 my-2">
                                                        <h5 class="card-text"> <strong> Telephone : </strong> </h5>
                                                    </div>
                                                    <div class="col-sm-9 my-2">
                                                        <h5 class="card-text"> {{ $current_user->telephone }} </h5>
                                                    </div>
                                                    <div class="col-sm-3 my-2">
                                                        <h5 class="card-text"> <strong> Role : </strong> </h5>
                                                    </div>

                                                    @php
                                                        $roles = $current_user->roles
                                                    @endphp
                                                    <div class="col-sm-9 my-2">
                                                        <h5 class="card-text">
                                                            @foreach ($roles as $role)
                                                                {{ $role->name }}
                                                            @endforeach
                                                        </h5>
                                                    </div>
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex align-items-start justify-content-end gap-2 mb-2">
                                        <div>
                                            {{-- <button type="button" class="btn btn-success"><i class="me-1"></i> Message</button> --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target=".update-profile"><i class="me-1"></i> Edit
                                                Profile</button>

                                        </div>
                                        {{-- <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded font-size-20"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" >Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-transparent shadow-none">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>


    <!-- end row -->
    <!--  Update Profile example -->
    <div class="modal fade update-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="update-profile" action="{{route('updateProfile',$current_user->id)}}">
                        @csrf
                        <input type="hidden" value="{{ $current_user->id }}" id="data_id">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                value="{{ $current_user->email }}" name="email" placeholder="Enter email" autofocus disabled>
                            <div class="text-danger" id="emailError" data-ajax-feedback="email"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ $current_user->name }}" id="name" name="name" autofocus
                                placeholder="Enter username">
                            <div class="text-danger" id="nameError" data-ajax-feedback="name"></div>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                value="{{ $current_user->telephone }}" id="telephone" name="telephone" autofocus
                                placeholder="Enter Telephone Number">
                            <div class="text-danger" id="telephoneError" data-ajax-feedback="telephone"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('telephone') is-invalid @enderror"
                                value="" id="password" name="password" autofocus
                                placeholder="">
                            <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control @error('telephone') is-invalid @enderror"
                                value="" id="password_confirmation" name="password_confirmation" autofocus
                                placeholder="">
                            <div class="text-danger" id="passwordConfirmationError" data-ajax-feedback="password_confirmation"></div>
                        </div>
                        <div class="mb-3">
                            <label for="avatar">Profile Picture</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    id="avatar" name="avatar" autofocus>
                                <label class="input-group-text" for="avatar">Upload</label>
                            </div>
                            <div class="text-start mt-2">
                                <img src="@if ($current_user->avatar != '') {{ URL::asset('images/' . $current_user->avatar) }}@else{{ URL::asset('assets/images/users/avatar-1.png') }} @endif"
                                    alt="" class="rounded-circle avatar-lg">
                            </div>
                            <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                        </div>

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light UpdateProfile"
                                data-id="{{ $current_user->id }}" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('page_scripts')
   
    <script>
        $('#update-profile').on('submit', function(event) {
            event.preventDefault();
            var Id = $('#data_id').val();
            let formData = new FormData(this);
            $('#emailError').text('');
            $('#nameError').text('');
            $('#avatarError').text('');
            $('#passwordError').text('');
            $('#passwordConfirmationError').text('');
            $.ajax({
                url: "{{ url('update-profile') }}" + "/" + Id,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#emailError').text('');
                    $('#nameError').text('');
                    $('#avatarError').text('');
                    $('#telephoneError').text('');

                    if (response.isSuccess == false) {
                        Swal.fire("Error", response.Message,
                        "error");
                        alert(response.Message);
                    } else if (response.isSuccess == true) {
                        setTimeout(function() {
                            Swal.fire({
                                    title: "Saved",
                                    text: "Profile updated successfully",
                                    icon: "success"
                                })
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function(response) {
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#avatarError').text(response.responseJSON.errors.avatar);
                    $('#telephoneError').text(response.responseJSON.errors.telephone);
                    $('#passwordError').text(response.responseJSON.errors.password);
                }
            });
        });
    </script>
@endpush
