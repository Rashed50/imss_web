@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>My Password Update</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="{{url('dashboard/member/password/update')}}" method="POST" enctype="multipart/form-data">
          @csrf
             <div class="form-group row mb-3 {{ $errors->has('old_pass') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Current Password<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control form_control" name="old_pass" value="">
                  @if ($errors->has('old_pass'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('old_pass') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="form-group row mb-3 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">New Password<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control form_control" name="password" value="">
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="form-group row mb-3 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Confirm Password<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control form_control" name="password_confirmation" value="">
                  @if ($errors->has('password_confirmation'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
          <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">UPDATE</button>
          </div>
      </form>
        </div>
      </div>
    </div>
    <div class="card-footer card_footer">
      
    </div>
</div>
@endsection
