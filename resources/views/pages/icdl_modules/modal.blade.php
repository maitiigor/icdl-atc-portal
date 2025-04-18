<div class="modal fade" id="mdl-icdlModule-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-icdlModule-modal-title" class="modal-title">ICDL Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-icdlModule-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-icdlModule-modal" role="form" method="POST"
                    enctype="multipart/form-data" action="">

                    <div class="col-lg-12 pe-2">

                        @csrf

                        <div class="offline-flag"><span class="offline-icdl_modules">You are currently offline</span>
                        </div>

                        <div id="spinner-icdl_modules" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <input type="hidden" id="txt-icdlModule-primary-id" value="0" />
                        <div id="div-show-txt-icdlModule-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.icdl_modules.show_fields')
                                </div>
                            </div>
                        </div>
                        <div id="div-edit-txt-icdlModule-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.icdl_modules.fields')
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>


            <div class="modal-footer" id="div-save-mdl-icdlModule-modal">
                <button type="button" class="btn btn-primary text-white" id="btn-save-mdl-icdlModule-modal"
                    value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
    <script type="module" src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/libs/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="module">
        $(document).ready(function() {

            // Initialize TinyMCE for the full_description field
            tinymce.init({
                selector: '#full_description',
                menubar: false,
                plugins: 'advlist autolink lists link image hr anchor',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar_mode: 'floating',
                height: 500,
                setup: function(editor) {
                    editor.on('change', function() {
                        tinymce.triggerSave(); // Ensure the textarea is updated with the editor content
                    });
                    editor.on('focus', function() {
                        if ($('.modal').hasClass('show')) {
                            $('body').addClass('modal-open');
                        }
                    });
                    editor.on('init', function() {
                        this.getContainer().addEventListener('click', function(e) {
                            if (e.target.closest('.tox-tinymce')) {
                                e.stopPropagation();
                            }
                        });
                    });
                     
                }
            });

            $('.offline-icdl_modules').hide();

            //Show Modal for New Entry
            $(document).on('click', ".btn-new-mdl-icdlModule-modal", function(e) {
                $('#div-icdlModule-modal-error').hide();
                $('#mdl-icdlModule-modal').modal('show');
                $('#frm-icdlModule-modal').trigger("reset");
                $('#txt-icdlModule-primary-id').val(0);
                $('#div-image_file_preview').hide();
                $('#image_file_preview').attr('src', "");

                $('#div-show-txt-icdlModule-primary-id').hide();
                $('#div-edit-txt-icdlModule-primary-id').show();

                $("#spinner-icdl_modules").hide();
                $("#div-save-mdl-icdlModule-modal").attr('disabled', false);
            });

            //Show Modal for View
            $(document).on('click', ".btn-show-mdl-icdlModule-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-icdl_modules').fadeIn(300);
                    return;
                } else {
                    $('.offline-icdl_modules').fadeOut(300);
                }

                $('#div-icdlModule-modal-error').hide();
                $('#mdl-icdlModule-modal').modal('show');
                $('#frm-icdlModule-modal').trigger("reset");

                $("#spinner-icdl_modules").show();
                $("#div-save-mdl-icdlModule-modal").attr('disabled', true);

                $('#div-show-txt-icdlModule-primary-id').show();
                $('#div-edit-txt-icdlModule-primary-id').hide();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.icdl_modules.show', '') }}/" + itemId).done(function(response) {

                    $('#txt-icdlModule-primary-id').val(response.data.id);
                    $('#spn_icdlModule_name').html(response.data.product_name);
                    $('#spn_icdlModule_amount').html(response.data.amount);
                    $('#spn_icdlModule_short_description').html(response.data.short_description);
                    $('#spn_icdlModule_full_desription').html(response.data.full_description);
                    $('#spn_icdlModule_is_available').html(response.data.is_available == 1 ? 'Yes' :
                        'No');
                    // $('#spn_icdlModule_image').html(response.data.image);
                    $('#spn_icdlModule_image img').attr('src', response.data.image ?? '');

                    $("#spinner-icdl_modules").hide();
                    $("#div-save-mdl-icdlModule-modal").attr('disabled', false);
                });
            });

            $('#image_file').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_file_preview').attr('src', e.target.result);
                    $('#div-image_file_preview').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            //Show Modal for Edit
            $(document).on('click', ".btn-edit-mdl-icdlModule-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#div-image_file_preview').hide();
                $('#image_file_preview').attr('src', "");

                $('#div-icdlModule-modal-error').hide();
                $('#mdl-icdlModule-modal').modal('show');
                $('#frm-icdlModule-modal').trigger("reset");

                $("#spinner-icdl_modules").show();
                $("#div-save-mdl-icdlModule-modal").attr('disabled', true);

                $('#div-show-txt-icdlModule-primary-id').hide();
                $('#div-edit-txt-icdlModule-primary-id').show();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.icdl_modules.show', '') }}/" + itemId).done(function(response) {
                    console.log($('#full_description'));

                    $('#txt-icdlModule-primary-id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#amount').val(response.data.amount);
                    $('#short_description').val(response.data.short_description);
                    // $('#full_description').val(response.data.full_description);
                    tinymce.get('full_description').setContent(response.data.full_description ||
                    '');
                    $('#is_available').prop('checked', response.data.is_available == 1 ? true :
                        false);
                    $('#color').val(response.data.color);
                    $('#parent_id').val(response.data.parent_id);

                    if (response.data.image != null) {
                        $('#div-image_file_preview').show();
                        $('#image_file_preview').attr('src', "{{ asset('') }}" + response.data
                            .image);
                    } else {
                        $('#div-image_file_preview').hide();
                        $('#image_file_preview').attr('src', "");
                    }
                    $("#spinner-icdl_modules").hide();
                    $("#div-save-mdl-icdlModule-modal").attr('disabled', false);
                });
            });

            //Delete action
            $(document).on('click', ".btn-delete-mdl-icdlModule-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-icdl_modules').fadeIn(300);
                    return;
                } else {
                    $('.offline-icdl_modules').fadeOut(300);
                }

                let itemId = $(this).attr('data-val');
                Swal.fire({
                    title: "Are you sure you want to delete this icdlModule?",
                    text: "You will not be able to recover this icdlModule if deleted.",
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
                            title: '<div id="spinner-icdl_modules" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
                            text: 'Deleting icdlModule.',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            // html: true
                        })

                        let endPointUrl = "{{ route('api.icdl_modules.destroy', '') }}/" + itemId;

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
                                        text: "icdlModule deleted successfully",
                                        icon: "success",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    });
                                    location.reload(true);

                                }
                            },
                        });
                    }
                });
            });

            //Save details
            $('#btn-save-mdl-icdlModule-modal').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });


                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-icdl_modules').fadeIn(300);
                    return;
                } else {
                    $('.offline-icdl_modules').fadeOut(300);
                }

                $("#spinner-icdl_modules").show();
                $("#div-save-mdl-icdlModule-modal").attr('disabled', true);

                let actionType = "POST";
                let endPointUrl = "{{ route('api.icdl_modules.store') }}";
                let primaryId = $('#txt-icdlModule-primary-id').val();

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                if (primaryId != "0") {
                    actionType = "PUT";
                    endPointUrl = "{{ route('api.icdl_modules.update', '') }}/" + primaryId;
                    formData.append('id', primaryId);
                }

                if ($('#parent_id').length) {
                    formData.append('parent_id', $('#parent_id').val());
                }

                formData.append('_method', actionType);

                // formData.append('', $('#').val());
                if ($('#image_file')[0].files.length > 0) {
                    formData.append('image_file', $('#image_file')[0].files[0]);
                }

                if ($('#name').length) {
                    formData.append('name', $('#name').val());
                }

                if ($('#short_description').length) {
                    formData.append('short_description', $('#short_description').val());
                }

                if ($('#color').length) {
                    formData.append('color', $('#color').val());
                }

                if (tinymce.get('full_description').getContent().length) {
                    formData.append('full_description', tinymce.get('full_description').getContent());
                    // Prevent TinyMCE editor from scrolling to the top when a menu button is clicked

                }

                if ($('#amount').length) {
                    formData.append('amount', $('#amount').val());
                }

                if ($('#is_available').length) {
                    formData.append('is_available', $('#is_available').is(':checked') ? 1 : 0);
                }






                {{-- 
        Swal.fire({
            title: '<div id="spinner-icdl_modules" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
            text: 'Saving Module',
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
                            $('#div-icdlModule-modal-error').html('');
                            $('#div-icdlModule-modal-error').show();

                            $.each(result.errors, function(key, value) {
                                $('#div-icdlModule-modal-error').append(
                                    '<li class="">' + value + '</li>');
                            });
                        } else {
                            $('#div-icdlModule-modal-error').hide();


                            $('#div-icdlModule-modal-error').hide();

                            Swal.fire({
                                title: "Saved",
                                text: "ICDL Module saved successfully",
                                icon: "success"
                            })
                            location.reload(true);



                        }

                        $("#spinner-icdl_modules").hide();
                        $("#div-save-mdl-icdlModule-modal").attr('disabled', false);

                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire("Error", "Oops an error occurred. Please try again.",
                            "error");

                        $("#spinner-icdl_modules").hide();
                        $("#div-save-mdl-icdlModule-modal").attr('disabled', false);

                    }
                });
            });

        });
    </script>
@endpush
