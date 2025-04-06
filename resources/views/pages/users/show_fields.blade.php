<!-- Name Field -->
<div id="div_customer_name" class="col-lg-12">
    <p>
        {!! html()->label('Name:')->class('control-label') !!} 
        <span id="spn_customer_name">
        @if (isset($customer->name) && empty($customer->name)==false)
            {!! $customer->name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Available Cbm Field -->
<div id="div_customer_available_cbm" class="col-lg-12">
    <p>
        {!! html()->label('Available Cbm:')->class('control-label') !!} 
        <span id="spn_customer_available_cbm">
        @if (isset($customer->available_cbm) && empty($customer->available_cbm)==false)
            {!! $customer->available_cbm !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Accumulated Cbm Field -->
<div id="div_customer_accumulated_cbm" class="col-lg-12">
    <p>
        {!! html()->label('Accumulated Cbm:')->class('control-label') !!} 
        <span id="spn_customer_accumulated_cbm">
        @if (isset($customer->accumulated_cbm) && empty($customer->accumulated_cbm)==false)
            {!! $customer->accumulated_cbm !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

