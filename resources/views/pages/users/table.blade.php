@section('app_css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('page_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts()!!}
@endpush