<!-- Product Name Field -->
<div id="div-customer_id" class="form-group">
    <label for="customer_id" class="col-lg-12 col-form-label">Customer</label>
    <div class="col-lg-12">
        <select name="customer_id" id="customer_id" class="form-select">
            <option value=""> -- select customer --</option>
            @foreach ($customers as $customer)
                <option value="{{$customer->id}}"> {{$customer->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Product Name Field -->
<div id="div-reference_reciept" class="form-group">
    <label for="reference_recipet" class="col-lg-12 col-form-label">Reference Reciept</label>
    <div class="col-lg-12">
        {!! html()->text('reference_reciept')->value(null)->id('reference_reciept')->class('form-control') !!}
    </div>
</div>

<!-- Product Name Field -->
<div id="div-product_name" class="form-group">
    <label for="product_name" class="col-lg-12 col-form-label">Product Name</label>
    <div class="col-lg-12">
        {!! html()->text('product_name')->value(null)->id('product_name')->class('form-control') !!}
    </div>
</div>

<!-- Start Quantity Field -->
<div id="div-quantity" class="form-group">
    <label for="quantity" class="col-lg-12 col-form-label">Quantity</label>
    <div class="col-lg-12">
        {!! html()->text('quantity')->value(null)->id('quantity')->class('form-control') !!}
    </div>
</div>
<!-- End Quantity Field -->

<!-- Start Price Per Item Field -->
<div id="div-type" class="form-group">
    <label for="type" class="col-lg-12 col-form-label">Type</label>
    <div class="col-lg-12">
        {!! html()->text('type')->value(null)->id('type')->class('form-control') !!}
    </div>
</div>
<!-- End Price Per Item Field -->

<!-- Start cbm Field -->
<div id="div-item-type" class="form-group">
    <label for="item_type" class="col-lg-12 col-form-label">CBM</label>
    <div class="col-lg-12">
        {!! html()->number('item_type')->value(null)->id('item_type')->class('form-control') !!}
    </div>
</div>
<!-- End cbm Field -->