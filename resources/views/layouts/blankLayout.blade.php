@extends('layouts/commonMaster' )

@section('layoutContent')

<!-- Content -->
@yield('content')
@yield('library')
@yield('custom-css')
@yield('vendor-javascript')
@yield('custom-javascript')
<!--/ Content -->

@endsection
