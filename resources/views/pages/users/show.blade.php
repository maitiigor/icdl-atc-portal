@extends('layouts.app')
@section('title_postfix')
    Customers
@stop

@section('page_title')
    Customers
@stop

@section('page_title_suffix')
    All $customer->title
@stop

@section('app_css')
    @include('layouts.datatables_css')
@stop

@section('page_title_subtext')
    <a class="ms-1" href="{{ route('dashboard') }}">
        <i class="bx bx-chevron-left"></i> Back to Dashboard
    </a>

@stop
@section('page_title_buttons')
    <a id="btn-new-mdl-customers-modal" class="btn btn-sm btn-primary btn-new-mdl-faculties-modal">
        <i class="fas fa-plus-square me-1"></i>New Customers
    </a>
    <a data-toggle="tooltip" title="Edit" data-val='{{ $customer->id }}'
        class="btn btn-sm btn-primary btn-edit-mdl-customer-modal" href="#">
        <i class="fa fa-pencil-square-o"></i> Edit
    </a>
@stop


@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Customers
        @endslot
        @slot('li_link')
            {{ route('customers.index') }}
        @endslot
        @slot('title')
            {{ $customer->name }}
        @endslot
    @endcomponent
    <div class="card border-top border-0 border-4 border-primary">

        <div class="card-body">

            @include('pages.customers.modal')
            @include('pages.customers.show_fields')

            <ul class="mt-3 nav nav-tabs nav-primary" role="tablist">

    
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#payroll"
                        aria-selected="false" href="">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-ship font-18 me-1"></i></div>
                            <div class="tab-title">Shipments</div>
                        </div>
                    </a>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="shipments" role="tabpanel">
                    <div class="mt-3 row">

                        <div class="col-md-12">
                            @include('pages.users.table')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('side-panel')
    <div class="card radius-5 border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div>
                <h5 class="card-title">More Information</h5>
            </div>
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
