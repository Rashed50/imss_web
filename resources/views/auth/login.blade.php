@extends('layouts.app')
@section('content')
<!-- <div class="card-header bg-img">
    <div class="bg-overlay"></div>
    <h3 class="text-center m-t-10 text-white"> Login</h3>
</div>
<div class="card-body">
  <form class="form-horizontal m-t-20" action="{{ route('login') }}" method="post">
      @csrf
      <div class="form-group">
          <div class="col-12">
              <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="form-group">
          <div class="col-12">
              <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="form-group">
          <div class="col-12">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="checkbox-signup">
                      Remember me
                  </label>
              </div>

          </div>
      </div>

      <div class="form-group text-center m-t-40">
          <div class="col-12">
              <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
          </div>
      </div>

      <div class="form-group row m-t-30">
          <div class="col-sm-7">
              <a href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
          </div>
          <div class="col-sm-5 text-right">
              <a href="{{ route('register') }}">Create an account</a>
          </div>
      </div>
  </form>











</div> -->

  <!-- login form -->
  <form class="form-horizontal m-t-20" action="{{ route('login') }}" method="post">
      @csrf
      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse"><span class="tx-info tx-normal">Login</span></div>
        <div class="form-group">
          <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <!-- form-group -->
        <div class="form-group">
          <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          <a href="{{ route('password.request') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
        </div>
        <!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">Sign In</button>
      </div>
  </form>
@endsection
