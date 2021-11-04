@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{route('user')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> User Registration</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{route('user')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All User</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-7">
                      @if(Session::has('success'))
                        <div class="alert alert-success alertsuccess" role="alert">
                           <strong>Success!</strong> {{Session::get('success')}}
                        </div>
                      @endif
                      @if(Session::has('error'))
                        <div class="alert alert-danger alerterror" role="alert">
                           <strong>Opps!</strong> {{Session::get('error')}}
                        </div>
                      @endif
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label">Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label">Phone:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label">Email<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label">Password<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="password" class="form-control" name="password" value="">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label">Confirm-Password<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label">User Role<span class="req_star">*</span>:</label>
                  <div class="col-sm-4">
                    @php
                      $allRole=App\Models\UserRole::orderBy('role_id','ASC')->get();
                    @endphp
                    <select class="form-control" name="role">
                      <option value="">Choose Role</option>
                      @foreach($allRole as $urole)
                      <option value="{{$urole->role_id}}">{{$urole->role_name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label">Photo:</label>
                  <div class="col-sm-4">
                        <input type="file"  id="image" class="mdc-text-field__input" id="text-field-hero-input">
                  </div>
                  <img height="70" id="showImage"/>
              </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-md btn-dark">REGISTRATION</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
