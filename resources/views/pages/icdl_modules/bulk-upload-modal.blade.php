
<a id="btn-mdl-bulk-upload-claimableItem-modal" class="btn btn-primary btn-mdl-bulk-upload-claimableItem-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <i class="bx bx-upload"></i> Bulk Upload
</a>

<div class="modal fade" id="mdl-bulk-upload-claimableItem-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="lbl-claimableItem-modal-title-bku" class="modal-title">Bulk Upload</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-claimableItem-modal-error-bku" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-claimableItem-modal-bku" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-mdl-bulk-upload-claimableItem-modal" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-11 ma-10">

                                    <div id="div-value-key" class="form-group">
                                        <div class="col-sm-12">
                                            You may select a comma separated value (csv) file containing data that can be uploaded. The format of the <span style="font-weight:bold;">expected CSV file</span> is indicated below, only properly formatted will be successfully uploaded. 
                                        </div>
                                    </div>

                                    <div id="div-value" class="form-group">
                                        <div class="col-sm-12">
                                            
                                            {!! Form::file('mdl-bulk-upload-claimableItem-modal-file', ['class' => 'form-control', 'id'=>'mdl-bulk-upload-claimableItem-modal-file']) !!}

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-upload-mdl-claimableItem-modal-bku" class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-upload-mdl-claimableItem-modal" value="add">Upload</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for Bulk Upload
    $(document).on('click', ".btn-mdl-bulk-upload-claimableItem-modal", function(e) {
        $('#div-claimableItem-modal-error-bku').hide();
        $('#mdl-bulk-upload-claimableItem-modal').modal('show');
        $('#frm-claimableItem-modal-bku').trigger("reset");

        $("#spinner-mdl-bulk-upload-claimableItem-modal").hide();
        $("#btn-upload-mdl-claimableItem-modal").attr('disabled', false);
    });

    //Save details
    $('#btn-upload-mdl-claimableItem-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-mdl-bulk-upload-claimableItem-modal").show();
        $("#btn-upload-mdl-claimableItem-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "###### PATH TO UPLOAD #####";
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());        
        formData.append('_method', actionType);
        formData.append('value', $('#value-file')[0].files[0]);
        

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
                    $('#div-claimableItem-modal-error-bku').html('');
                    $("#spinner-mdl-bulk-upload-claimableItem-modal").show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-claimableItem-modal-error-bku').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-claimableItem-modal-error-bku').hide();
                    window.setTimeout( function(){

                        $('#div-claimableItem-modal-error-bku').hide();
                        swal({
                                title: "Saved",
                                text: "Bulk upload completed successfully",
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            },function(){
                                location.reload(true);
                        });

                    },20);
                }

                $("#spinner-mdl-bulk-upload-claimableItem-modal").hide();
                $("#btn-upload-mdl-claimableItem-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-mdl-bulk-upload-claimableItem-modal").hide();
                $("#btn-upload-mdl-claimableItem-modal").attr('disabled', false);
            }
        });
    });

});
</script>
@endpush
