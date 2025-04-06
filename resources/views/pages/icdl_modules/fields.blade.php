<!-- Parent Module Name Field -->
<div class="row">
    <div class="col-md-5">
        @if (isset($parentModules) && empty($parentModules) == false)


            <div id="div-parent_id" class="form-group">
                <label for="parent_id" class="col-lg-12 col-form-label">Parent Module</label>
                <div class="col-lg-12">
                    <select name="parent_id" id="parent_id" class="form-select">
                        <option value="">-- parent module--</option>
                        @foreach ($parentModules as $parentModule)
                            <option value="{{ $parentModule->id }}">{{ $parentModule->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        @endif

        <!-- Product Name Field -->
        <div id="div-name" class="form-group">
            <label for="name" class="col-lg-12 col-form-label">Module Name</label>
            <div class="col-lg-12">
                {!! html()->text('name')->value(null)->id('name')->class('form-control') !!}
            </div>
        </div>


        <!-- Short Description Field -->
        <div id="div-short-description" class="form-group">
            <label for="short-description" class="col-lg-12 col-form-label">Short Decription</label>
            <div class="col-lg-12">
                {!! html()->text('short_description')->value(null)->id('short_description')->class('form-control') !!}
            </div>
        </div>
        <!-- Short Description Field -->

        <!-- amount Field -->
        <div id="div-amount" class="form-group">
            <label for="amount" class="col-lg-12 col-form-label">Amount</label>
            <div class="col-lg-12">
                {!! html()->number('amount')->value(null)->id('amount')->attributes(['min' => 0])->class('form-control') !!}
            </div>
        </div>



        <!-- IS Available Field -->
        <div id="div-is-available" class="form-group">
            <label for="is_available" class="col-lg-12 col-form-label">Is Available</label>
            <div class="col-lg-12">
                <div class="form-check">
                    <input type="checkbox" name="is_available" id="is_available" class="form-check-input">
                    <label class="form-check-label" for="is_available">Available</label>
                </div>
            </div>
        </div>
        <!-- IS Available Field -->

        <!-- Start Featured Image Field -->
        <div id="div-image" class="form-group">
            <label for="image" class="col-lg-12 col-form-label">Feature Image</label>
            <div class="col-lg-12">
                <input type="file" name="image_file" id="image_file" class="form-contol">
            </div>
        </div>

        <div id="div-image_file_preview">
            <div class="col-lg-12 d-flex justify-center">
                <img id="image_file_preview" src="" alt="Image Preview" style="max-width: 100%; height: 400px;">
            </div>
        </div>

    </div>

    <div class="col-md-7">
        <!-- full Description Field -->
        <div id="div-full-description" class="form-group">
            <label for="full-description" class="col-lg-12 col-form-label">Full Description</label>
            <div class="col-lg-12">
                {!! html()->textarea('full_description')->attributes(["rows" => 50])->value(null)->id('full_description')->class('form-control') !!}
            </div>
        </div>
        <!-- full Description Field -->
    </div>
</div>
