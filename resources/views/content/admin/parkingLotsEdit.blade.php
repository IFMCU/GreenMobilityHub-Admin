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
  <h1>Edit Data Parking Lot</h1>

  <div class="row">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-body">
          <form id="form">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Name*</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-guid" value="{{$dataResults['data']['guid']}}" hidden />
                <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" value="{{$dataResults['data']['name']}}" required/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Country*</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-country" placeholder="Indonesia" value="{{$dataResults['data']['country']}}" required/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">City*</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-city" placeholder="Bandung" value="{{$dataResults['data']['city']}}" required/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Phone Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-phone-number" placeholder="08123456" value="{{$dataResults['data']['phone_number']}}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Available Spots*</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-available-spots" placeholder="1000" value="{{$dataResults['data']['available_spots']}}" required/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-latitude">Latitude*</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-latitude" placeholder="-7.33089487" value="{{$dataResults['data']['latitude']}}" required/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-longitude">Longitude*</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-longitude" placeholder="110.49487667" value="{{$dataResults['data']['longitude']}}" required/>
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
      var guid = $("#basic-default-guid").val();
      var name = $("#basic-default-name").val();
      var country = $("#basic-default-country").val();
      var city = $("#basic-default-city").val();
      var phoneNumber = $("#basic-default-phone-number").val();
      var availableSpot = $("#basic-default-available-spots").val();
      var latitude = $("#basic-default-latitude").val();
      var longitude = $("#basic-default-longitude").val();

      $.ajax({
        type: "PUT",
        url: "{{ env('URL_API') }}/api/v1/parkinglot",
        data: {
          'guid': guid,
          'name': name,
          'country': country,
          'city': city,
          'phone_number': phoneNumber,
          'available_spots': availableSpot,
          'latitude': latitude,
          'longitude': longitude,
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
            window.location.href = "/parking_lots";
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