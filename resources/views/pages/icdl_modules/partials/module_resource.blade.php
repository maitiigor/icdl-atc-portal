
<div class="block my-2">

    <a id="btn-mdl-bulk-upload-module-resource-modal" class="btn btn-sm text-white float-end btn-primary btn-mdl-bulk-upload-module-resource-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <i class="bx bx-upload"></i> Upoad Resource
    </a>
</div>

<div class="modal fade" id="mdl-bulk-upload-module-resource-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="lbl-module-resource-modal-title-bku" class="modal-title">Module Resource</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-module-resource-modal-error-bku" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-module-resource-modal-bku" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-mdl-bulk-upload-module-resource-modal" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-11 ma-10">

                                    <div id="div-value" class="form-group mb-3">
                                        <div class="col-sm-12">
                                            <label for="" class="form-label col-sm-12">
                                                Resource name
                                            </label>
                                           <input type="text" class="form-control" id="resource_name" name="resource_name" placeholder="Resource name">

                                        </div>
                                    </div>

                                    <div id="div-value" class="form-group">
                                        <div class="col-sm-12">
                                            
                                            {!! html()->file('resource_file')->class( 'form-control')->id('resource_file') !!}

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-upload-mdl-module-resource-modal-bku" class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-upload-mdl-module-resource-modal" value="add">Upload</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="module">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for Bulk Upload
    $(document).on('click', ".btn-mdl-bulk-upload-module-resource-modal", function(e) {
        $('#div-module-resource-modal-error-bku').hide();
        $('#mdl-bulk-upload-module-resource-modal').modal('show');
        $('#frm-module-resource-modal-bku').trigger("reset");

        $("#spinner-mdl-bulk-upload-module-resource-modal").hide();
        $("#btn-upload-mdl-module-resource-modal").attr('disabled', false);
    });

    $('.btn-delete-mdl-icdlModuleResource-modal').click(function(e) {
        e.preventDefault();
        let resourceId = $(this).data('val');
        let actionType = "DELETE";
        let endPointUrl = "{{route('icdl_module.resources.destroy', ':id')}}";
        endPointUrl = endPointUrl.replace(':id', resourceId);
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                $.ajax({
                    url:endPointUrl,
                    type: actionType,
                    dataType: 'json',
                    success: function(result){
                        if(result.success){
                            Swal.fire("Deleted!", result.message, "success");
                            setTimeout(function(){
                                location.reload(true);
                            }, 1000);
                        }else{
                            Swal.fire("Error", result.message, "error");
                        }
                    }, error: function(data){
                        console.log(data);
                        Swal.fire("Error", "Oops an error occurred. Please try again.", "error");
                    }
                });
            }
        });
    });

    //Save details
    $('#btn-upload-mdl-module-resource-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-mdl-bulk-upload-module-resource-modal").show();
        $("#btn-upload-mdl-module-resource-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{route('icdl_module.resources.store')}}";
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());        
        formData.append('_method', actionType);
        if($('#resource_file')[0].files.length == 0){
            $('#div-module-resource-modal-error-bku').html('<li class="">Please select a file</li>');
            $("#spinner-mdl-bulk-upload-module-resource-modal").hide();
            $("#btn-upload-mdl-module-resource-modal").attr('disabled', false);
            return;
        }
        
        formData.append('resource_file', $('#resource_file')[0].files[0]);
        formData.append('resource_name', $('#resource_name').val());
        @if (isset($icdlModule) && $icdlModule->id != null)
            formData.append('icdl_module_id', '{{ $icdlModule->id }}');      
        @endif
      

        $.ajax({
            url:endPointUrl,
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            dataType: 'json',
            success: function(result){
                if(result.errors){
                    $('#div-module-resource-modal-error-bku').html('');
                    $("#spinner-mdl-bulk-upload-module-resource-modal").show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-module-resource-modal-error-bku').append('<li class="">'+value+'</li>');
                    });
                    $('#div-module-resource-modal-error-bku').show();
                }else{
                    $('#div-module-resource-modal-error-bku').hide();
                    window.setTimeout( function(){

                        $('#div-module-resource-modal-error-bku').hide();
                        Swal.fire({
                                title: "Saved",
                                text: "Module Resource uploaded successfully",
                                icon: "success",
                                showCancelButton: false,
                             
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            });
                            setTimeout(function(){
                                $('#mdl-bulk-upload-module-resource-modal').modal('hide');
                                location.reload(true);
                            }, 1000);

                    },20);
                }

                $("#spinner-mdl-bulk-upload-module-resource-modal").hide();
                $("#btn-upload-mdl-module-resource-modal").attr('disabled', false);
                
            }, error: function(data){
               console.log(data);
               
                if(data.status == 422){
                    $('#div-module-resource-modal-error-bku').html('');
                    $("#spinner-mdl-bulk-upload-module-resource-modal").show();
                    
                    $.each(data.responseJSON.errors, function(key, value){
                        $('#div-module-resource-modal-error-bku').append('<li class="">'+value+'</li>');
                    });
                    $('#div-module-resource-modal-error-bku').show();
                }else{
                
                    Swal.fire("Error", "Oops an error occurred. Please try again.", "error");
                }
                $("#spinner-mdl-bulk-upload-module-resource-modal").hide();
                $("#btn-upload-mdl-module-resource-modal").attr('disabled', false);
            }
        });
    });

});
</script>
@endpush
