@extends('layouts.app')

@section('app_css')
@stop

@section('title_postfix')
Create Shipment Item
@stop

@section('page_title')
Create Shipment Item
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('
claimable_items.index') }}">
    <i class="bx bx-chevron-left"></i> Back to Shipment Item Dashboard
</a>
@stop

@section('page_title_buttons')
{{--
<a id="btn-new-mdl-shipmentItem-modal" class="btn btn-sm btn-primary btn-new-mdl-shipmentItem-modal">
    <i class="bx bx-book-add me-1"></i>New Shipment Item
</a>
--}}
@stop

@section('content')
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-4">
            <div class="card-title d-flex align-items-center">
                <div>
                    <i class="bx bxs-user me-1 font-22 text-primary"></i>
                </div>
                <h5 class="mb-0 text-primary">Shipment Item Details</h5>
            </div>
            <hr />
            {!! html()->form('POST',  'cliamable_items.store')->class('form-horizontal') !!}
            
                @include('pages.claimable_items.fields')

                <div class="col-lg-offset-3 col-lg-9">
                    <hr />
                    {!! html()->submit('Save')->class('btn btn-primary') !!}
                    <a href="{{ route('claiamable_items.index') }}" class="btn btn-default btn-warning">Cancel</a>
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