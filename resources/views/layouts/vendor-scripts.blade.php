<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>

<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/feather-icons/feather-icons.min.js') }}"></script>
{{-- <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script> --}}
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<!-- pace js -->
<script src="{{ URL::asset('assets/libs/pace-js/pace-js.min.js') }}"></script>
@stack('page_scripts')

@yield('script-bottom')

