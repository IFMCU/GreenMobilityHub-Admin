@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Register Card -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <!-- <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span> -->
            <span class="app-brand-text demo text-heading fw-semibold">Green Mobility</span>
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
          <h4 class="mb-2">Adventure starts here 🚀</h4>
          <p class="mb-4">Make your app management easy and fun!</p>

          <!-- <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET"> -->
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autocomplete="name" autofocus required>
              <label for="name">Name</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              <label for="email">Email</label>
            </div>
            <div class="mb-3">
              <div class="input-group input-group-merge">
              <span class="input-group-text">IDN (+62)</span>

                <div class="form-floating form-floating-outline">
                  <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="812 3456 7890" />
                  <label for="phone_number">Phone Number</label>
                </div>
              </div>
            </div>

            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
            </div>

            <!-- <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
              </div>
            </div> -->
            <button class="btn btn-primary d-grid w-100">
              Sign up
            </button>
          <!-- </form> -->

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{url('auth/login-basic')}}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection

@section('library')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#register").click(function(e) {
                    e.preventDefault();
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var phone_number = $("#phone_number").val();
                    var password = $("#password").val();
                    var password_confirmation = $("#password_confirmation").val();

                    if (password !== password_confirmation) {
                        $('#error-message-register').removeClass('d-none').text(
                            "{{ __('Passwords do not match') }}");
                        return;
                    }

                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone_number', phone_number);
                    formData.append('password', password);
                    formData.append('password_confirmation', password_confirmation);

                    $.ajax({
                        type: "POST",
                        url: "{{ env('URL_API') }}/api/v1/auth/register",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(resultLogin) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('session.register') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    guid: resultLogin.data.guid,
                                },
                                success: function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ env('URL_API') }}/api/v1/send-otp",
                                        data: {
                                            guid: resultLogin.data.guid,
                                        },
                                        beforeSend: function() {},
                                        success: function(resultLogin) {
                                            window.location =
                                                "/auth/otp/verify";
                                        },
                                        error: function(xhr, status, error) {
                                            var jsonResponse = JSON.parse(
                                                xhr.responseText);
                                            $('#error-message-register')
                                                .text(jsonResponse[
                                                    'message']);
                                            $('#error-message-register')
                                                .removeClass("d-none");
                                        }
                                    });
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            $('#error-message-register').text(jsonResponse['message']);
                            $('#error-message-register').removeClass("d-none");
                        }
                    });
                });
            });
        </script>
    @endsection