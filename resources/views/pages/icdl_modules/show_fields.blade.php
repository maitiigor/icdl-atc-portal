<!-- Product Name Field -->
<div id="div_icdlModule_name" class="col-lg-12">
    <p>
        {!! html()->label('Name:')->class('control-label') !!} 
        <span id="spn_icdlModule_name">
        @if (isset($icdlModule->name) && empty($icdlModule->name)==false)
            {!! $icdlModule->name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Short Description Field -->
<div id="div_icdlModule_short_description" class="col-lg-12">
    <p>
        {!! html()->label('Short Description:')->class('control-label') !!} 
        <span id="spn_icdlModule_short_description">
        @if (isset($icdlModule->short_description) && empty($icdlModule->short_description)==false)
            {!! $icdlModule->short_description !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>
<!-- End Short Description Field -->
<!-- Full Description Field -->
<div id="div_icdlModule_full_description" class="col-lg-12">
    <p>
        {!! html()->label('Full Description:')->class('control-label') !!} 
        <span id="spn_icdlModule_full_description">
        @if (isset($icdlModule->full_description) && empty($icdlModule->full_description)==false)
            {!! $icdlModule->full_description !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>
<!-- End Full Description Field -->
<!-- Amount Field -->   
<div id="div_icdlModule_amount" class="col-lg-12">
    <p>
        {!! html()->label('Amount:')->class('control-label') !!} 
        <span id="spn_icdlModule_amount">
        @if (isset($icdlModule->amount) && empty($icdlModule->amount)==false)
            {!! number_format($icdlModule->amount,2) !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>
<!-- End Amount Field -->
<!-- Is Available Field --> 
<div id="div_icdlModule_is_available" class="col-lg-12">
    <p>
        {!! html()->label('Is Available:')->class('control-label') !!} 
        <span id="spn_icdlModule_is_available">
        @if (isset($icdlModule->is_available) && empty($icdlModule->is_available)==false)
            YES
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Start Featured Image Field --> 
<div id="div_icdlModule_image" class="col-lg-12">
    <p>
        {!! html()->label('Feature Image:')->class('control-label') !!} 
        <span id="spn_icdlModule_image">
        @if (isset($icdlModule->image) && empty($icdlModule->image)==false)
            <div style="display: flex; align-items: center;">
            {{-- <label style="margin-right: 10px;">Image Preview:</label> --}}
            <img src="{{ asset($icdlModule->image) }}" alt="Image Preview" style="max-width: 100%; height: 400px;">
            </div>
        @else
            N/A
        @endif
        </span>
    </p>
</div>
<!-- End Featured Image Field -->
