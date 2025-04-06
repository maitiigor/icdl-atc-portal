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
  <a id="btn-new-mdl-users-modal" class="btn btn-sm btn-primary btn-new-mdl-users-modal">
                <i class="fas fa-plus-square me-1"></i>New users
            </a>
@stop



@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 hidden-sm hidden-xs">
        {{-- Summary Row --}}
    </div>
    
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            {{ $cdv_users->render() }}
        </div>
    </div>

    @include('pages.users.modal')
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
    {!! $cdv_users->render_js() !!}
@endpush