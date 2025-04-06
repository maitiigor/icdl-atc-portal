@extends('layouts.app')
@section('title_postfix')
    users
@stop

@section('page_title')
    users
@stop

@section('page_title_suffix')
    All users
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
    <a id="btn-new-mdl-users-modal" class="btn btn-sm btn-primary btn-new-mdl-user-modal">
        <i class="fas fa-plus-square me-1"></i>New users
    </a>
@stop

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Users
        @endslot
    @endcomponent
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 hidden-sm hidden-xs">
        {{-- Summary Row --}}
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end mb-4">
                    <a id="btn-new-mdl-users-modal"
                        class="btn btn-sm btn-primary text-white btn-new-mdl-user-modal">
                        <i class="fas fa-plus-square me-1"></i>New users
                    </a>

                    <a id="btn-mdl-bulk-upload-user-modal" class="btn btn-sm mx-1 btn-warning btn-mdl-bulk-upload-user-modal"
                        tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
                        <i class="bx bx-upload"></i> Bulk Upload
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                @include('pages.users.table')

            </div>

        </div>
    </div>

    @include('pages.users.modal')
    @include('pages.users.bulk-upload-modal')

@endsection

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
