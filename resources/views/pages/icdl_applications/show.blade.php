@extends('layouts.app')
@section('title_postfix')
Shipment Items
@stop

@section('page_title')
Shipment Items
@stop

@section('page_title_suffix')
All $shipmentItem->title
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
  <a id="btn-new-mdl-shipmentItems-modal" class="btn btn-sm btn-primary btn-new-mdl-faculties-modal">
                <i class="fas fa-plus-square me-1"></i>New Shipment Items
            </a>
             <a data-toggle="tooltip" 
                title="Edit" 
                data-val='{{$shipmentItem->id}}' 
                class="btn btn-sm btn-primary btn-edit-mdl-shipmentItem-modal" href="#">
                <i class="fa fa-pencil-square-o"></i> Edit
            </a>
@stop


@section('content')
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">

            @include('pages.shipment_items.modal') 
            @include('pages.shipment_items.show_fields')
            
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