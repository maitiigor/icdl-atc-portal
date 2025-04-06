@extends('layouts.app')
@section('title_postfix')
    ICDL Module
@stop

@section('page_title')
    ICDL Moudle
@stop

@section('page_title_suffix')
    {{ $icdlModule->name }}
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
   
@stop


@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            ICDL Module
        @endslot
    @endcomponent
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 d-flex gap-2 justify-content-end mb-4">
                  
                    <a id="btn-new-mdl-icdlModule-modal" class="btn btn-sm btn-primary btn-new-mdl-icdlModule-modal">
                        <i class="fas fa-plus-square me-1"></i>New ICDL SubModule
                    </a>
                    <a data-toggle="tooltip" title="Edit" data-val='{{ $icdlModule->id }}'
                        class="btn btn-sm btn-primary btn-edit-mdl-icdlModule-modal" href="#">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    {{-- <a id="btn-mdl-bulk-upload-customer-modal" class="btn btn-sm mx-1 btn-warning btn-mdl-bulk-upload-customer-modal"
                        tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
                        <i class="bx bx-upload"></i> Bulk Upload
                    </a> --}}

                </div>
             
            </div>

            @include('pages.icdl_modules.modal')
            @include('pages.icdl_modules.show_fields')
            @php
                $subModules = $icdlModule->subModules;
            @endphp
            @if (count($subModules))
                
            <div>
                <ul>
                    <li><strong>Sub Modules:</strong></li>
                    <ul>
                        @foreach ($subModules as $subModule)
                            <li> 
                                <div class="d-flex align-items-center gap-2">
                                    <span>{{ $subModule->name }}</span>
                                    <a href="{{ route('icdl_modules.show', $subModule->id) }}" class="text-primary" data-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="text-secondary btn-edit-mdl-icdlModule-modal" data-val="{{$subModule->id}}" data-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="text-danger btn-delete-mdl-icdlModule-modal" data-val="{{$subModule->id}}" data-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </li>
                         
                        @endforeach
                    </ul>
                </ul>
            </div>
            @endif

            <ul class="mt-3 nav nav-tabs nav-primary" role="tablist">


                <li class="nav-item" role="presentation">
                    <a class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#items"
                        aria-selected="false" href="">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="fas fa-users font-18 me-1"></i></div>
                            <div class="tab-title">Applicants </div>
                        </div>
                    </a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="items" role="tabpanel">
                    <div class="table-responsive">
                        @include('pages.icdl_modules.table')
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
