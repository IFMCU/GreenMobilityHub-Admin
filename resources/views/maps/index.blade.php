@extends('layouts/contentNavbarLayout')

@section('title', 'Maps')

@section('vendor-css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    #map {
        height: 65vh;
    }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="row my-2">
    <div class="col-md-12 col-lg-3 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-1">MAPS 📍</h3>
                <h5 class="pb-0 pt-2">Explore All Places 🗺</h5>
                <!-- <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
            </div>
            <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
        </div>
    </div>

    <div class="col-lg-9">
        <div class="card">
            <!-- <div class="card-header">
            <div class="d-flex align-items-center justify-content-center">
                <h5 class="card-title m-0 me-2">The Amount of Data in This Month</h5>
            </div>
        </div> -->
            <div class="card-body">
                <div class="row g-3 p-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-primary rounded shadow">
                                    <i class="mdi mdi-store mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="small mb-1">Alfamart</div>
                                <h5 class="mb-0">5</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-success rounded shadow">
                                    <i class="mdi mdi-store mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="small mb-1">Indomart</div>
                                <h5 class="mb-0">9</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-warning rounded shadow">
                                    <i class="mdi mdi-store mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="small mb-1">Alfamidi</div>
                                <h5 class="mb-0">18</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-info rounded shadow">
                                    <i class="mdi mdi-store mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="small mb-1">Griya</div>
                                <h5 class="mb-0">13</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center h-auto">
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('vendor-javascript')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('custom-javascript')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', (event) => {
        const map = L.map('map').setView([-7.330206979726604, 110.50427647041089], 14);

        const tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        const userIcon = L.icon({
            iconUrl: '{{ asset("assets/images/icon.png") }}',
            iconSize: [64, 64],
            iconAnchor: [32, 32],
            popupAnchor: [0, -20]
        });

        // Check if geolocation is supported and get user's current position
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userCoords = [position.coords.latitude, position.coords.longitude];
                const userMarker = L.marker(userCoords, {
                    icon: userIcon
                }).addTo(map);
                userMarker.bindPopup("You are here").openPopup();
                map.setView(userCoords, 14);
            }, error => {
                console.error("Error obtaining location", error);
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }

        // Data from the server
        const locations = @json($data['data']);

        // Define custom icon for location markers
        const locationIcon = L.icon({
            iconUrl: '{{ asset("assets/images/alfamart.png") }}', // Adjust the path to your icon image
            iconSize: [64, 64],
            iconAnchor: [32, 32],
            popupAnchor: [0, -20]
        });

        const parkIcon = L.icon({
            iconUrl: '{{ asset("assets/images/park.png") }}', // Adjust the path to your icon image
            iconSize: [64, 64],
            iconAnchor: [32, 32],
            popupAnchor: [0, -20]
        });

        // Add markers for each location
        locations.forEach(location => {
            const marker = L.marker([location.latitude, location.longitude], {
                icon: locationIcon
            }).addTo(map);
            marker.bindPopup(`<b>${location.name}</b><br>${location.description}`).openPopup();
        });

        const parks = @json($dataPark['data']);


        parks.forEach(location => {
            const marker = L.marker([location.latitude, location.longitude], {
                icon: parkIcon
            }).addTo(map);
            marker.bindPopup(`<b>${location.name}</b><br>${location.available_spots} park spots`).openPopup();
        });


        map.on('click', function(e) {
            const latLng = e.latlng;
            const popupContent = `
                    <form id="markerForm" class="p-3" style="width: 300px;">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="available_spots">Available Spots:</label>
                            <input type="number" class="form-control" id="available_spots" name="available_spots" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
                    </form>
                `;
            const userAddedMarker = L.marker([latLng.lat, latLng.lng]).addTo(map);
            userAddedMarker.bindPopup(popupContent).openPopup();

            document.getElementById('submitButton').addEventListener('click', function() {
                const form = document.getElementById('markerForm');
                const formData = new FormData(form);
                formData.append('latitude', latLng.lat);
                formData.append('longitude', latLng.lng);

                $.ajax({
                    url: "{{ env('URL_API') }}/api/v1/parkinglot", // Your API endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                        $("#card-block").block({
                            message: '<div class="spinner-border text-primary" role="status"></div>',
                            css: {
                                backgroundColor: "transparent",
                                border: "0"
                            },
                            overlayCSS: {
                                backgroundColor: "#fff",
                                opacity: 0.8
                            }
                        });
                    },
                    success: function(result) {
                        $.unblockUI();
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 1000;
                        toastr.options.onHidden = function() {
                            var url = "{{ route('dashboard-maps') }}";
                            window.location.href = url;
                        };
                        toastr.success("Success add data", "Success");
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            toastr.options.closeButton = true;
                            toastr.error(jsonResponse['message'], "Error");
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                            console.error("Response text:", xhr.responseText);
                            toastr.error("An error occurred", "Error");
                        }
                    },
                    complete: function() {
                        $.unblockUI();
                    }
                });
            });
        });
    });
</script>
@endsection