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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection

@section('content')
<div class="container">
  <h1>Edit Data Merchant</h1>

  <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-body">
            <form id="form">

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name" >Merchant Name*</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="guid" value="{{$dataResults['data']['guid']}}" hidden />
                  <input type="text" class="form-control" id="basic-default-name" placeholder="Alfamart" value="{{$dataResults['data']['name']}}" required/>
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

@section('custom-javascript')
<script type="text/javascript">
    $(document).ready(function() {
      $('#form').on('submit', function(e) {
        e.preventDefault();
        var guid = $("#guid").val();
        var name = $("#basic-default-name").val();

        $.ajax({
          type: "PUT",
          url: "{{ env('URL_API') }}/api/v1/merchantmaster",
          data: {
            'guid' : guid,
            'name': name,
          },
          beforeSend: function(request) {
            request.setRequestHeader("Authorization",
              "Bearer {{ $token }}");

              $("#insert-block").block({
                  message: '<div class="spinner-border text-primary" role="status"></div>',
                  css: {
                      backgroundColor: "transparent",
                      border: "0"
                  },
                  overlayCSS: {
                      backgroundColor: "#fff",
                      opacity: .8
                  }
              });

          },
          success: function(data) {
            $.unblockUI();
            toastr.options.closeButton = true;
            toastr.options.timeOut = 1000;
            toastr.options.onHidden = function() {
              window.location.href = "/merchants";
            }
            toastr.success(
              "Success edit data", "Success"
            );
          },
          error: function(data) {
            $.unblockUI();
            var jsonResponse = JSON.parse(xhr.responseText);

            toastr.options.closeButton = true;
            toastr.error(
              jsonResponse['message'],
              "Error",
            );
          }
        });

      })
    })
</script>
@endsection