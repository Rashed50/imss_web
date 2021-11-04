@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Update My Information </h4>
            </div>
        </div>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7"></div>
                <div class="col-md-2"></div>
            </div>
            <form method="post" action="{{url('dashboard/member/information/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" name="name" value="{{Auth::user()->name ?? ''}}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label class="col-sm-3 col-form-label col_form_label">Phone<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" name="phone" value="{{Auth::user()->phone}}" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                      <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="email" class="form-control form_control" name="email" value="{{Auth::user()->email}}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row mb-3 {{ $errors->has('username') ? ' has-error' : '' }}">
                      <label class="col-sm-3 col-form-label col_form_label">User Name<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="birththday" name="username" value="{{Auth::user()->username?? ''}}" readonly>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                </div>
             </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                        <div class="col-sm-5">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file btnu_browse">
                                      Browse… <input type="file" name="pic" id="imgInp">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                          </div>
                        </div>
                        <div class="col-md-2">
                            <img id="img-upload" src="{{(Auth::user()->photo!='')?asset('uploads/users/'.Auth::user()->photo):asset('uploads/avatar/avatar-black.png')}}">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="card-footer card_footer text-center">
              <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
          </div>
    </div>
    </form>
    <div class="card-footer card_footer">

    </div>
</div>
@endsection
