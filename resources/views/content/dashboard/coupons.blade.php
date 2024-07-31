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
<script type="text/javascript">
    function reedem(el) {
     

      
      var offer_guid = $(el).data('guid');
      var point = $(el).data('point');

      console.log(offer_guid,point)
      $.ajax({
        type: "POST",
        url: "{{ env('URL_API') }}/api/v1/offer/reedem",
        data: {
          'user_guid': '{{ $guid }}',
          'offer_guid': offer_guid,
          'point': point,
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
            window.location.href = "/merchants_locations";
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

    }
</script>
@endsection

@section('content')
<div class="row gy-4 ">
  <!-- <h1>Carbon Calculator</h1> -->

  <div class="col-md-12 col-lg-12 text-center">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title mb-1">Redeem Your Points!</h3>
        <h6 class="pb-0">let's count how many points you've made!!</h6>
      </div>
    </div>
  </div>

  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header">
        <div class="row d-flex float-end">
          <div class="col-md-12 ">
            Point Anda : <b>{{ $point }}</b> point
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row d-flex justify-content-center">
        @foreach ($dataResults['data'] as $dataResult)
              <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                  <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                      <img src="https://cdn.discordapp.com/attachments/1014442386857926666/1268166766324875306/d973b742e23459677f38bda38d294dd4.png?ex=66ab6fd6&is=66aa1e56&hm=be48385261388307c9d0ccc8cba1b25085606656d294000d46bcdc78e3a34057&" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        @if($dataResult['user_guid'] === $guid)
                          <h3 class="card-title">{{ $dataResult['offer']['name'] }}</h3>
                          <h5 class="card-text" >{{ $dataResult['offer']['merchant_masters']['name'] }}</h5>
                          <h5 class="card-text" >{{ $dataResult['code'] }}</h5>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

