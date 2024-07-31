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
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-3 text-center">
    <div class="card">
      <div class="card-body text-start">
        <h3 class="card-title mb-2">Hi {{ $name }}! 👋🏻</h3>
        <h5 class="pb-0">Welcome to <br>Green Mobility Hub🎉</h5>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>
  <!--/ Congratulations card -->


  <!-- Transactions -->
  <div class="col-lg-9">
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-center">
          <h5 class="card-title m-0 me-2">The Amount of Data in This Month</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-primary rounded shadow">
                  <i class="mdi mdi-store mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Merchants</div>
                <h5 class="mb-0">{{ $totalMerchants }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-warning rounded shadow">
                  <i class="mdi mdi-store-alert mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Merchant Locations</div>
                <h5 class="mb-0">{{ $totalMerchantLocations }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-success rounded shadow">
                  <i class="mdi mdi-account-outline mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Users</div>
                <h5 class="mb-0">{{ $totalUsers }}</h5>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-info rounded shadow">
                  <i class="mdi mdi-parking mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Parking Lots</div>
                <h5 class="mb-0">{{ $totalParkingLots }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->

  <!-- Total Earnings -->
  <div class="col-xl-4 col-md-6">
    <div class="card" style="height: 30rem;">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Total Merchant</h5>
        <!-- <div class="dropdown">
          <button class="btn p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-dots-vertical mdi-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div> -->
      </div>
      <div class="card-body">
        <div class="mt-md-0 mb-md-2">
          <div class="d-flex align-items-center">
            <h2 class="mb-0">{{ $totalMerchants }} Merchants</h2>
            <!-- <span class="text-success ms-2 fw-medium">
              <i class="mdi mdi-menu-up mdi-24px"></i>
              <small>10%</small>
            </span> -->
          </div>
          <!-- <small class="mt-1">Compared to $84,325 last year</small> -->
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex pb-md-2">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/zipcar.png')}}" alt="zipcar" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Alfamart</h6>
                <!-- <small>Vuejs, React & HTML</small> -->
              </div>
              <!-- <div>
                <h6 class="mb-2">1</h6>
                <div class="progress bg-label-primary" style="height: 4px;">
                  <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div> -->
            </div>
          </li>
          <li class="d-flex pb-md-2">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/bitbank.png')}}" alt="bitbank" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Indomaret</h6>
                <!-- <small>Sketch, Figma & XD</small> -->
              </div>
              <!-- <div>
                <h6 class="mb-2">2</h6>
                <div class="progress bg-label-info" style="height: 4px;">
                  <div class="progress-bar bg-info" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div> -->
            </div>
          </li>
          <li class="d-flex mb-md-3">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/aviato.png')}}" alt="aviato" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Alfamidi</h6>
                <!-- <small>HTML & Angular</small> -->
              </div>
              <!-- <div>
                <h6 class="mb-2">3</h6>
                <div class="progress bg-label-secondary" style="height: 4px;">
                  <div class="progress-bar bg-secondary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div> -->
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Total Earnings -->

  <!-- Sales by Countries -->
  <div class="col-xl-4 col-md-6">
    <div class="card" style="height: 30rem;"  >
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Merchant Location by City</h5>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <div class="avatar-initial bg-label-success rounded-circle">US</div>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">Indomaret</h6>
              </div>
              <small>Bandung</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">21</h6>
            <small>Locations</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">Alfamart</h6>
                <!-- <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                <small class="text-danger">6.2%</small> -->
              </div>
              <small>Bandung</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">31</h6>
            <small>Locations</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">Alfamart</h6>
                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                <small class="text-success"> 12.4%</small> -->
              </div>
              <small>Salatiga</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">18</h6>
            <small>Locations</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">Alfamidi</h6>
                <!-- <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                <small class="text-danger"></small> -->
              </div>
              <small>Salatiga</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">14</h6>
            <small>Locations</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">Alfamidi</h6>
                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                <small class="text-success">16.2%</small> -->
              </div>
              <small>Bandung</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">15</h6>
            <small>Location</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sales by Countries -->
  <!-- Four Cards -->
  <div class="col-xl-4 col-md-6">
    <div class="card" style="height: 30rem;">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class=" text-center mt-2">Scan this QR to Join Our App!</h5>
      </div>
      <div class="card-body" style="height: auto;width:100%;">
        <img src="https://cdn.discordapp.com/attachments/1014442386857926666/1268135081478717473/WhatsApp_Image_2024-07-27_at_20.31.03_8b1cbc00.jpg?ex=66ab5254&is=66aa00d4&hm=64b4fcc43bf9ee72616369d105576368f54d595f8eb6c18955eba4b0f18bc4c8&" style="height: auto;width:100%;" alt="">
      </div>
    </div>
          

      <!--/ Sessions chart -->
      
  </div>
  <!--/ Total Earning -->



  <!-- Data Tables -->
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th class="text-truncate">Name Merchant</th>
              <th class="text-truncate">City</th>
              <th class="text-truncate">Country</th>
              <th class="text-truncate">Phone Number</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0 text-truncate">Alfamart Tingkir Tengah</h6>
                    <small class="text-truncate">Alfamart</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">salatiga</td>
              <td class="text-truncate"> Indonesia</td>
              <td class="text-truncate">+621234567890</td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0 text-truncate">Alfamart Tingkir Tengah</h6>
                    <small class="text-truncate">Alfamart</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">salatiga</td>
              <td class="text-truncate"> Indonesia</td>
              <td class="text-truncate">+621234567890</td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0 text-truncate">Alfamart Tingkir Tengah</h6>
                    <small class="text-truncate">Alfamart</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">salatiga</td>
              <td class="text-truncate"> Indonesia</td>
              <td class="text-truncate">+621234567890</td>
            </tr>
          </tbody>
        </table>
      </div>
      <a href="/merchants_locations" class="btn w-100">Open More Data</a>
    </div>
  </div>
  <!--/ Data Tables -->
</div>
@endsection