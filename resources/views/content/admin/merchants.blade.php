@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#merchantTable').DataTable();
  });
</script>
@endsection

@section('content')
<div class="row gy-4">
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-auto me-auto">
            <h1>Data Merchant </h1>
          </div>
          <div class="col-auto">
            <a href="merchants/add" class="btn btn-success"><i class='mdi mdi-plus mdi-24px'></i></a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive text-nowrap">
        <table id="merchantTable" class="display table ">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            @foreach ($dataResults['data'] as $dataResult)
            <tr>
              <td>{{ $dataResult['name'] }}</td>
              <td>
                <div style="display: flex; gap: 10px;">
                  <a class="nav-link dropdown-toggle hide-arrow p-0" href="merchants/edit/{{ $dataResult['guid'] }}">
                    <i class='mdi mdi-pen mdi-24px'></i>
                  </a>

                  <a class="nav-link dropdown-toggle hide-arrow p-0" href="merchants/delete/{{ $dataResult['guid'] }}">
                    <i class='mdi mdi-trash-can mdi-24px'></i>
                  </a>
                </div>
              </td>

            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection