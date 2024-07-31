@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4 ">
  <!-- <h1>Carbon Calculator</h1> -->

  <div class="col-md-12 col-lg-12 text-center">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title mb-1">Carbon Calculator!</h3>
        <h6 class="pb-0">let's count how many carbons you've made!!</h6>
      </div>
    </div>
  </div>

  <div class="col-xxl">
    <div class="card mb-4">
      <!-- <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Basic Layout</h5> <small class="text-muted float-end">Default label</small>
      </div> -->
      <div class="card-body">
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <label for="type" class="form-label">Tipe Kendaraan</label>
              <select class="form-select" aria-label="Default select example" id="type">
                <option selected>Open this select menu</option>
                <option value="mobil">Mobil</option>
                <option value="motor">Motor</option>
                <option value="bus">Bus</option>
              </select>            
            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection