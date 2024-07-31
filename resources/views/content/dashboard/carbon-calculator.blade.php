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
        <form>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Mileage</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="basic-default-name" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Vehicle</label>
            <div class="col-sm-10">
              <select id="multicol-vehicle" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="multicol-vehicle" tabindex="-1" aria-hidden="true">
                <option value="" data-select2-id="2">Select</option>
                <option value="car" data-select2-id="76">Car</option>
                <option value="motorcycle" data-select2-id="77">Motorcycle</option>
              </select>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Count</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection