<div class="modal fade" id="mdl-shipmentItem-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-shipmentItem-modal-title" class="modal-title">Shipment Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-shipmentItem-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-shipmentItem-modal" role="form" method="POST"
                    enctype="multipart/form-data" action="">

                    <div class="col-lg-12 pe-2">

                        @csrf

                        <div class="offline-flag"><span class="offline-shipment_items">You are currently offline</span>
                        </div>

                        <div id="spinner-shipment_items" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <input type="hidden" id="txt-shipmentItem-primary-id" value="0" />
                        <div id="div-show-txt-shipmentItem-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.shipment_items.show_fields')
                                </div>
                            </div>
                        </div>
                        <div id="div-edit-txt-shipmentItem-primary-id">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('pages.shipment_items.fields')
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>


            <div class="modal-footer" id="div-save-mdl-shipmentItem-modal">
                <button type="button" class="btn btn-primary text-white" id="btn-save-mdl-shipmentItem-modal"
                    value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
    <script type="module">
        $(document).ready(function() {

            $('.offline-shipment_items').hide();

            //Show Modal for New Entry
            $(document).on('click', ".btn-new-mdl-shipmentItem-modal", function(e) {
                $('#div-shipmentItem-modal-error').hide();
                $('#mdl-shipmentItem-modal').modal('show');
                $('#frm-shipmentItem-modal').trigger("reset");
                $('#txt-shipmentItem-primary-id').val(0);

                $('#div-show-txt-shipmentItem-primary-id').hide();
                $('#div-edit-txt-shipmentItem-primary-id').show();

                $("#spinner-shipment_items").hide();
                $("#div-save-mdl-shipmentItem-modal").attr('disabled', false);
            });

            //Show Modal for View
            $(document).on('click', ".btn-show-mdl-shipmentItem-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-shipment_items').fadeIn(300);
                    return;
                } else {
                    $('.offline-shipment_items').fadeOut(300);
                }

                $('#div-shipmentItem-modal-error').hide();
                $('#mdl-shipmentItem-modal').modal('show');
                $('#frm-shipmentItem-modal').trigger("reset");

                $("#spinner-shipment_items").show();
                $("#div-save-mdl-shipmentItem-modal").attr('disabled', true);

                $('#div-show-txt-shipmentItem-primary-id').show();
                $('#div-edit-txt-shipmentItem-primary-id').hide();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.shipment_items.show', '') }}/" + itemId).done(function(response) {

                    $('#txt-shipmentItem-primary-id').val(response.data.id);
                    $('#spn_shipmentItem_product_name').html(response.data.product_name);
                    $('#spn_shipmentItem_quantity').html(response.data.quantity);
                    $('#spn_shipmentItem_type').html(response.data.type);


                    $("#spinner-shipment_items").hide();
                    $("#div-save-mdl-shipmentItem-modal").attr('disabled', false);
                });
            });

            //Show Modal for Edit
            $(document).on('click', ".btn-edit-mdl-shipmentItem-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#div-shipmentItem-modal-error').hide();
                $('#mdl-shipmentItem-modal').modal('show');
                $('#frm-shipmentItem-modal').trigger("reset");

                $("#spinner-shipment_items").show();
                $("#div-save-mdl-shipmentItem-modal").attr('disabled', true);

                $('#div-show-txt-shipmentItem-primary-id').hide();
                $('#div-edit-txt-shipmentItem-primary-id').show();
                let itemId = $(this).attr('data-val');

                $.get("{{ route('api.shipment_items.show', '') }}/" + itemId).done(function(response) {

                    $('#txt-shipmentItem-primary-id').val(response.data.id);
                    $('#product_name').val(response.data.product_name);
                    $('#reference_reciept').val(response.data.reference_reciept);
                    $('#customer_id').val(response.data.customer_id);
                    $('#quantity').val(response.data.quantity);
                    $('#type').val(response.data.type);
                    $('#item_type').val(response.data.cbm);



                    $("#spinner-shipment_items").hide();
                    $("#div-save-mdl-shipmentItem-modal").attr('disabled', false);
                });
            });

            //Delete action
            $(document).on('click', ".btn-delete-mdl-shipmentItem-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-shipment_items').fadeIn(300);
                    return;
                } else {
                    $('.offline-shipment_items').fadeOut(300);
                }

                let itemId = $(this).attr('data-val');
                Swal.fire({
                    title: "Are you sure you want to delete this ShipmentItem?",
                    text: "You will not be able to recover this ShipmentItem if deleted.",
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
                            title: '<div id="spinner-shipment_items" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
                            text: 'Deleting ShipmentItem.',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                           // html: true
                        })

                        let endPointUrl = "{{ route('api.shipment_items.destroy', '') }}/" + itemId;

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
                                        text: "ShipmentItem deleted successfully",
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

            $('#btn-bulk-delete-mdl-shipmentItem-modal').click(function(e) {
                let select_items = []
                $('.item-checkbox:checked').each(function() {
                 
                    select_items.push($(this).attr('data-val'));
                })
                if (select_items.length > 0) {

                    Swal.fire({
                        title: "Are you sure you want to delete these selected Shipment Items?",
                        text: "You will not be able to recover this Shipment Items if deleted.",
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
                                title: '<div id="spinner-shipments" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
                                text: 'Deleting Shipments.',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                //    html: true
                            })

                            let endPointUrl = "{{ route('api.shipment_items.bulk.delete', '') }}";

                            let formData = new FormData();
                            formData.append('_token', $('input[name="_token"]').val());
                            formData.append('_method', 'DELETE');
                            console.log(select_items);
                            
                            formData.append("selected_items", select_items.join(','));

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
                                            text: "Shipment deleted successfully",
                                            icon: "success",
                                            confirmButtonClass: "btn-success",
                                            confirmButtonText: "OK",
                                            closeOnConfirm: false
                                        })
                                        location.reload(true);

                                    }
                                },
                            });
                        }
                    });
                } else {
                    Swal.fire("Error",
                        "You have not selected any item.",
                        "info");

                }

            })

            //Save details
            $('#btn-save-mdl-shipmentItem-modal').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });


                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline-shipment_items').fadeIn(300);
                    return;
                } else {
                    $('.offline-shipment_items').fadeOut(300);
                }

                $("#spinner-shipment_items").show();
                $("#div-save-mdl-shipmentItem-modal").attr('disabled', true);

                let actionType = "POST";
                let endPointUrl = "{{ route('api.shipment_items.store') }}";
                let primaryId = $('#txt-shipmentItem-primary-id').val();

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                if (primaryId != "0") {
                    actionType = "PUT";
                    endPointUrl = "{{ route('api.shipment_items.update', '') }}/" + primaryId;
                    formData.append('id', primaryId);
                }

                formData.append('_method', actionType);
                @if (isset($shipment))
                    formData.append("shipment_id", "{{ $shipment->id }}");
                @endif
                // formData.append('', $('#').val());
                if ($('#product_name').length) {
                    formData.append('product_name', $('#product_name').val());
                }

                if ($('#customer_id').length) {
                    formData.append('customer_id', $('#customer_id').val());
                }

                if ($('#reference_reciept').length) {
                    formData.append('reference_reciept', $('#reference_reciept').val());
                }

                if ($('#quantity').length) {
                    formData.append('quantity', $('#quantity').val());
                }
                if ($('#type').length) {
                    formData.append('type', $('#type').val());
                }

                if ($('#item_type').length) {
                    formData.append('cbm', $('#item_type').val());
                }


                {{-- 
        Swal.fire({
            title: '<div id="spinner-shipment_items" class="spinner-border text-primary" role="status"> <span class="visually-hidden">  Processing...  </span> </div> <br><br> Please wait...',
            text: 'Saving ShipmentItem',
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
                            $('#div-shipmentItem-modal-error').html('');
                            $('#div-shipmentItem-modal-error').show();

                            $.each(result.errors, function(key, value) {
                                $('#div-shipmentItem-modal-error').append(
                                    '<li class="">' + value + '</li>');
                            });
                        } else {
                            $('#div-shipmentItem-modal-error').hide();


                            $('#div-shipmentItem-modal-error').hide();

                            Swal.fire({
                                title: "Saved",
                                text: "ShipmentItem saved successfully",
                                icon: "success"
                            })
                            location.reload(true);



                        }

                        $("#spinner-shipment_items").hide();
                        $("#div-save-mdl-shipmentItem-modal").attr('disabled', false);

                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire("Error", "Oops an error occurred. Please try again.",
                            "error");

                        $("#spinner-shipment_items").hide();
                        $("#div-save-mdl-shipmentItem-modal").attr('disabled', false);

                    }
                });
            });

        });
    </script>
@endpush
