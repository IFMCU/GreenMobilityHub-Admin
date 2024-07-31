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
  <h1>Add Data Users</h1>

  <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-body">
            <form id="form">
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

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
                <div class="col-sm-10">
                  <select name="basic-default-role" id="basic-default-role" class="form-select">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="merchant">Merchant</option>
                  </select>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Add Data</button>
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

      var name = $("#basic-default-name").val();
      var email = $("#basic-default-email").val();
      var phoneNumber = $("#basic-default-phone-number").val();
      var point = $("#basic-default-point").val();

      var role = $("#basic-default-role").val();

      $.ajax({
        type: "POST",
        url: "{{ env('URL_API') }}/api/v1/user",
        data: {

          'name': name,
          'email': email,
          'point': point,
          'phone_number': phoneNumber,
          'role': role,
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
            window.location.href = "{{ route('users') }}";
          }
          toastr.success(
            "Success insert data", "Success"
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