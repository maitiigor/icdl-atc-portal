<!-- Name Field -->
<div id="div-name" class="form-group">
    <label for="name" class="col-lg-12 col-form-label">Name</label>
    <div class="col-lg-12">
        {!! html()->text('name')->value(null)->id('name')->class('form-control') !!}
    </div>
</div>

<div class="row">

    <!-- Name Field -->
    <div id="div-email" class="form-group col-md-6">
        <label for="email" class="col-lg-12 col-form-label">Email Address</label>
        <div class="col-lg-12">
            {!! html()->email('email')->value(null)->id('email')->class('form-control') !!}
        </div>
    </div>
    
    <!-- Name Field -->
    <div id="div-telephone" class="form-group col-md-6">
        <label for="telephone" class="col-lg-12 col-form-label">Telephone Number</label>
        <div class="col-lg-12">
            {!! html()->text('telephone')->value(null)->id('telephone')->class('form-control') !!}
        </div>
    </div>
</div>

<div class="row">
    <!-- Start Password Field -->
    <div id="div-password" class="form-group col-md-6">
        <label for="password" class="col-lg-12 col-form-label">Password</label>
        <div class="col-lg-12">
            {!! html()->password('password')->value(null)->id('password')->class('form-control') !!}
            {{-- <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
            </button> --}}
        </div>
    </div>
    <!-- End Password Field -->
    
    <!-- Start Password Confirmation Field -->
    <div id="div-password_confirmation" class="form-group col-md-6">
        <label for="password_confirmation" class="col-lg-12 col-form-label">Password Confirmation</label>
        <div class="col-lg-12">
            {!! html()->password('password_confirmation')->value(null)->id('password_confirmation')->class('form-control') !!}
            {{-- <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
            </button> --}}
        </div>
    </div>
    <!-- End Password Confirmation Field -->

</div>


<div class="row">
    <!-- Start Password Field -->
    <div id="div-role" class="form-group col-md-6">
        <label for="role" class="col-lg-12 col-form-label">Role</label>
        <div class="col-lg-12">
            <select name="role" id="role" class="form-select">
                <option value=""> -- select a role --</option>
                @foreach ($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
   
</div>