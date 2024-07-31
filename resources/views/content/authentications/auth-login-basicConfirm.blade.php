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

          <div class="form-floating form-floating-outline mb-3">
            <!-- <input type="text" class="form-control" id="email" name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->

            <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

            <label for="email">Email</label>
          </div>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <div class="mb-3">
            <div class="form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">

                  <!-- <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" /> -->

                  <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    name="password" required autocomplete="current-password">


                  <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <a href="{{url('auth/forgot-password-basic')}}" class="float-end mb-1">
              <span>Forgot Password?</span>
            </a>
          </div>
          <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" id="login">Sign in</button>
          </div>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p>
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
<script type="text/javascript">
  $(document).ready(function() {

    $("#login").click(function(e) {
      e.preventDefault();

      var emailAddress = $("#email").val();
      var loginPassword = $("#password").val();

      $.ajax({
        type: "POST",
        url: "{{ env('URL_API') }}/api/v1/auth/login",
        data: {
          email: emailAddress,
          password: loginPassword,
        },
        success: function(resultLogin) {
          $.ajax({
            type: "GET",
            url: "{{ env('URL_API') }}/api/v1/user/self",
            beforeSend: function(request) {
              request.setRequestHeader("Authorization",
                "Bearer " + resultLogin.data.access_token);
            },
            success: function(result) {
              // console.log(result)
              $.ajax({
                type: "POST",
                url: "{{ route('session.login') }}",
                data: {
                  _token: "{{ csrf_token() }}",
                  access_token: resultLogin.data
                    .access_token,
                  name: result.data.name,
                  guid: result.data.guid,
                  point: result.data.point,
                  
                },
                success: function() {
                   window.location = "/dashboard";
                }
              });
            },
            error: function(xhr) {
              var jsonResponse = JSON.parse(xhr.responseText);
              $('#error-message-login').text(jsonResponse
                .message);
              $('#error-message-login').removeClass("d-none");
            }
          });
        },
        error: function(xhr) {
          var jsonResponse = JSON.parse(xhr.responseText);
          $('#error-message-login').text(jsonResponse.message);
          $('#error-message-login').removeClass("d-none");
        }
      });
    });
  });
</script>
@endsection