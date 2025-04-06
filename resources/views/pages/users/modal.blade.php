<div class="modal fade" id="mdl-user-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-user-modal-title" class="modal-title">user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-user-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-user-modal" role="form" method="POST"
                    enctype="multipart/form-data" action="">

                    <div class="col-lg-12 pe-2">

                        @csrf

                        <div class="offline-flag"><span class="offline-users">You are currently offline</span></div>

                        <div id="spinner-users" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <input type="hidden" id="txt-user-primary-id" value="0" />
                        <div id="div-show-txt-user-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.users.show_fields')
                                </div>
                            </div>
                        </div>
                        <div id="div-edit-txt-user-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.users.fields')
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>


            <div class="modal-footer" id="div-save-mdl-user-modal">
                <button type="button" class="btn text-white btn-primary" id="btn-save-mdl-user-modal"
                    value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.offline-users').hide();

            //Show Modal for New Entry
            $(document).on('click', ".btn-new-mdl-user-modal", function(e) {
                $('#div-user-modal-error').hide();
                $('#mdl-user-modal').modal('show');
                $('#frm-user-modal').trigger("reset");
                $('#txt-user-primary-id').val(0);

                $('#div-show-txt-user-primary-id').hide();
                $('#div-edit-txt-user-primary-id').show();

                $("#spinner-users").hide();
                $("#div-save-mdl-user-modal").attr('disabled', false);
            });

            //Show Modal for View
            $(document).on('click', ".btn-show-mdl-user-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-users').fadeIn(300);
                    return;
                } else {
                    $('.offline-users').fadeOut(300);
                }

                $('#div-user-modal-error').hide();
                $('#mdl-user-modal').modal('show');
                $('#frm-user-modal').trigger("reset");

                $("#spinner-users").show();
                $("#div-save-mdl-user-modal").attr('disabled', true);

                $('#div-show-txt-user-primary-id').show();
                $('#div-edit-txt-user-primary-id').hide();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.users.show', '') }}/" + itemId).done(function(response) {

                    $('#txt-user-primary-id').val(response.data.id);
                    $('#spn_user_name').html(response.data.name);
                    $('#spn_user_available_cbm').html(response.data.available_cbm);
                    $('#spn_user_accumulated_cbm').html(response.data.accumulated_cbm);


                    $("#spinner-users").hide();
                    $("#div-save-mdl-user-modal").attr('disabled', false);
                });
            });

            //Show Modal for Edit
            $(document).on('click', ".btn-edit-mdl-user-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#div-user-modal-error').hide();
                $('#mdl-user-modal').modal('show');
                $('#frm-user-modal').trigger("reset");

                $("#spinner-users").show();
                $("#div-save-mdl-user-modal").attr('disabled', true);

                $('#div-show-txt-user-primary-id').hide();
                $('#div-edit-txt-user-primary-id').show();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.users.show', '') }}/" + itemId).done(function(response) {

                    $('#txt-user-primary-id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#telephone').val(response.data.telephone);
                    $('#email').val(response.data.email);
                    $('#role').val(response.data.roles[0]?.name ?? '')
                    $('#telephone').val(response.data.telephone);


                    $("#spinner-users").hide();
                    $("#div-save-mdl-user-modal").attr('disabled', false);
                });
            });

            //Delete action
            $(document).on('click', ".btn-delete-mdl-user-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-users').fadeIn(300);
                    return;
                } else {
                    $('.offline-users').fadeOut(300);
                }

                let itemId = $(this).attr('data-val');
                Swal.fire({
                    title: "Are you sure you want to delete this user?",
                    text: "You will not be able to recover this user if deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: '<div id="spinner-users" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
                            text: 'Deleting user.',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            html: true
                        })

                        let endPointUrl = "{{ route('api.users.destroy', '') }}/" + itemId;

                        let formData = new FormData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('_method', 'DELETE');

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
                                    Swal.fire("Error",
                                        "Oops an error occurred. Please try again.",
                                        "error");
                                } else {
                                    Swal.fire({
                                        title: "Deleted",
                                        text: "user deleted successfully",
                                        icon: "success",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    }, function() {
                                        location.reload(true);
                                    });
                                }
                            },
                        });
                    }
                });
            });

            //Save details
            $('#btn-save-mdl-user-modal').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });


                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-users').fadeIn(300);
                    return;
                } else {
                    $('.offline-users').fadeOut(300);
                }

                $("#spinner-users").show();
                $("#div-save-mdl-user-modal").attr('disabled', true);

                let actionType = "POST";
                let endPointUrl = "{{ route('api.users.store') }}";
                let primaryId = $('#txt-user-primary-id').val();

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                if (primaryId != "0") {
                    actionType = "PUT";
                    endPointUrl = "{{ route('api.users.update', '') }}/" + primaryId;
                    formData.append('id', primaryId);
                }

                formData.append('_method', actionType);

                // formData.append('', $('#').val());
                if ($('#name').length) {
                    formData.append('name', $('#name').val());
                }
                if ($('#password').length) {
                    formData.append('password', $('#password').val());
                }
                if ($('#password_confirmation').length) {
                    formData.append('password_confirmation', $('#password_confirmation').val());
                }
                if ($('#email').length) {
                    formData.append('email', $('#email').val());
                }
                if ($('#role').length) {
                    formData.append('role', $('#role').val());
                }
                if ($('#telephone').length) {
                    formData.append('telephone', $('#telephone').val());
                }


                {{-- 
        Swal.fire({
            title: '<div id="spinner-users" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
            text: 'Saving user',
            showConfirmButton: false,
            allowOutsideClick: false,
            html: true
        })
        --}}

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
                            $('#div-user-modal-error').html('');
                            $('#div-user-modal-error').show();

                            $.each(result.errors, function(key, value) {
                                $('#div-user-modal-error').append('<li class="">' +
                                    value + '</li>');
                            });
                        } else {
                            $('#div-user-modal-error').hide();


                            $('#div-user-modal-error').hide();



                            setTimeout(() => {
                                Swal.fire({
                                    title: "Saved",
                                    text: "user saved successfully",
                                    icon: "success"
                                })
                                location.reload(true);
                            }, 200);



                        }

                        $("#spinner-users").hide();
                        $("#div-save-mdl-user-modal").attr('disabled', false);

                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire("Error", "Oops an error occurred. Please try again.",
                            "error");

                        $("#spinner-users").hide();
                        $("#div-save-mdl-user-modal").attr('disabled', false);

                    }
                });
            });

        });
    </script>
@endpush
