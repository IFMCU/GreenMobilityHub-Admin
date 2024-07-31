@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
<div class="container">
  <h1>Edit Data Users</h1>

  <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-body">
            <form>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" />
                </div>
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-email" placeholder="johnDoe@gmail.com" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Phone Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-email" placeholder="+6522235" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Point</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-email" placeholder="100" />
                </div>
              </div>
              
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('page-script')

@endsection