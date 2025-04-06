@extends('layouts.app')
@section('title')
    @lang('translation.Dashboard')
@endsection
{{-- @section('app_css')
    {!! $cdv_customers->render_css() !!}
@stop --}}

@section('page-head')
    @component('components.breadcrumb')
        @slot('li_1')
           
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-primary"><a href="{{route('dashboard')}}">Dasboard</a></li>

                <li class="breadcrumb-item active">Users</li>

            </ol>
        @endslot
        @slot('title')
           <a href="{{ route('users.create') }}" id="btn-new-users" class="btn btn-sm btn-primary">
                <i class="bx bx-book-add mr-1"></i>New Customer
            </a>
        @endslot
    @endcomponent
@endsection



@section('content')
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-4">

        <div class="card-title d-flex align-items-center">
            <div>
                <i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Modify Customer Details</h5>
        </div>

        {!! html()->modelForm($customer,'PUT',route('payroll.customers.update', $customer->id) )->class('form-horizontal') !!}

            @include('pages.customers.fields')

            <div class="col-lg-offset-3 col-lg-9">
                <hr/>
                {!! html()->submit('Save')->class('btn btn-primary') !!}
                <a href="{{ route('payroll.customers.show', $customer->id) }}" class="btn btn-warning btn-default">Cancel</a>
            </div>
        {!! html()->form()->close() !!}                

    </div>
</div>
@stop

@section('side-panel')
<div class="card radius-5 border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div><h5 class="card-title">More Information</h5></div>
        <p class="small">
            This is the help message.
            This is the help message.
            This is the help message.
        </p>
    </div>
</div>
@stop

@push('page_scripts')
@endpush