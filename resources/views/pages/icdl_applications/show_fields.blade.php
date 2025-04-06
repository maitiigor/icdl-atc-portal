<!-- Product Name Field -->
<div id="div_shipmentItem_product_name" class="col-lg-12">
    <p>
        {!! html()->label('Product Name:')->class('control-label') !!} 
        <span id="spn_shipmentItem_product_name">
        @if (isset($shipmentItem->product_name) && empty($shipmentItem->product_name)==false)
            {!! $shipmentItem->product_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Quantity Field -->
<div id="div_shipmentItem_quantity" class="col-lg-12">
    <p>
        {!! html()->label('Quantity:')->class('control-label') !!} 
        <span id="spn_shipmentItem_quantity">
        @if (isset($shipmentItem->quantity) && empty($shipmentItem->quantity)==false)
            {!! $shipmentItem->quantity !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Price Per Item Field -->
<div id="div_shipmentItem_price_per_item" class="col-lg-12">
    <p>
        {!! html()->label('Price Per Item:')->class('control-label') !!} 
        <span id="spn_shipmentItem_price_per_item">
        @if (isset($shipmentItem->price_per_item) && empty($shipmentItem->price_per_item)==false)
            {!! $shipmentItem->price_per_item !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

