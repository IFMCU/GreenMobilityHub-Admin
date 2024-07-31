@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <!-- <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span> -->
            <span class="app-brand-text demo text-heading fw-semibold">Green Mobility</span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2">
          <h4 class="mb-2">Welcome to Green Mobility! 👋</h4>
          <p class="mb-4">Please sign-in to your account and start the adventure</p>

          <form id="loginForm" class="mb-3" action="javascript:void(0)" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" value="{{ old('email') }}" autocomplete="email" required autofocus>
              <label for="email">Email</label>
            </div>
            <div class="mb-3 d-flex justify-content-between">
              <a href="{{url('auth/forgot-password-basic')}}" class="float-end mb-1">
                <span>Forgot Password?</span>
              </a>
            </div>
            <div class="mb-3">
              <!-- <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button> -->
              <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>

            </div>
          </form>
          <hr>
          <p class="mb-0">
            @if (Route::has('register'))
            Not registered yet? <a href="{{ route('register') }}">{{ __('Register here') }}</a>
            @endif
          </p>
          <!-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p> -->
        </div>
      </div>
      <!-- /Login -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection

@section('library')
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/auth/login",
                    data: formData,
                    success: function(response) {
                        if (response.data === true) {
                            window.location = "{{ route('google-auth') }}";
                        } else {
                            window.location = "/login-password";
                        }
                    },
                    error: function(xhr, status, error) {
                        var jsonResponse = JSON.parse(xhr.responseText);
                        $('#error-message-login').text(jsonResponse['message']);
                        $('#error-message-login').removeClass("d-none");
                    }
                });
            });
        });
    </script>
@endsection
