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

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  $(document).ready(function() {

    $('#merchantTable').DataTable();

  });

  $(document).on("click", ".open-delete-dialog", function() {
                var guid = $(this).data('guid');
                $("#delete-id").val(guid);
            });

  $('#delete-form').on('submit', function(e) {
      e.preventDefault();

      var guid = $('#delete-id').val();

      $.ajax({
          type: "DELETE",
          url: "{{ env('URL_API') }}/api/v1/merchantlocation/" + guid,
          data: {

          },
          beforeSend: function(request) {
              request.setRequestHeader("Authorization",
                  "Bearer {{ $token }}");

              $("#card-block").block({
                  message: '<div class="spinner-border text-primary" role="status"></div>',
                  timeout: 1e3,
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
          success: function(result) {
              $.unblockUI();
              toastr.options.closeButton = true;
              toastr.options.timeOut = 1000;
              toastr.options.onHidden = function() {
                location.reload()
              }
              toastr.success(
                  "Success delete data", "Success"
              );
          },
          error: function(xhr, status, error) {
              $.unblockUI();
              var jsonResponse = JSON.parse(xhr.responseText);

              toastr.options.closeButton = true;
              toastr.error(
                  jsonResponse['message'],
                  "Error",
              );
          }
      });
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
            <h1>Data Merchant Locations</h1>
          </div>
          <div class="col-auto">
            <a href="merchants_locations/add" class="btn btn-success"><i class='mdi mdi-plus mdi-24px'></i></a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive text-nowrap">
        <table id="merchantTable" class="display table ">
          <thead>
            <tr>
              <th>Name</th>
              <th>Country</th>
              <th>City</th>
              <th>Phone Number</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($dataResults['data'] as $dataResult)

            <tr>
              <td>{{ $dataResult['name'] }}</td>
              <td>{{ $dataResult['country'] }}</td>
              <td>{{ $dataResult['city'] }}</td>
              <td>{{ $dataResult['phone_number'] }}</td>

              <td>
                <div style="display: flex; gap: 10px;">
                  <a class="nav-link dropdown-toggle hide-arrow p-0" href="merchants_locations/edit/{{ $dataResult['guid'] }}">
                    <i class='mdi mdi-pen mdi-24px'></i>
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalDelete" data-guid="{{ $dataResult['guid'] }}" class="btn btn-sm btn-icon item-edit open-delete-dialog"><i class=" mdi mdi-trash-can mdi-20px"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Delete Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <p>Are you sure want to delete this data?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form id="delete-form">
                                    <input id="delete-id" class="d-none" />
                                    <button type="button" class="btn btn-label-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button"
                                        data-bs-dismiss="modal">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection