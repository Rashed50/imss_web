@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/user/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update User Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/user')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All User</a>
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
                  <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="id" value="{{$data->id}}"/>
                    <input type="hidden" name="slug" value="{{$data->slug}}"/>
                    <input type="text" class="form-control form_control" name="name" value="{{$data->name}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="phone" value="{{$data->phone}}">
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="email" value="{{$data->email}}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                  <div class="col-sm-4">
                    @php
                      $allRole=App\Models\UserRole::where('role_status',1)->orderBy('role_id','ASC')->get();
                    @endphp
                    <select class="form-control form_control" name="role">
                      <option value="">Choose Role</option>
                      @foreach($allRole as $urole)
                      <option value="{{$urole->role_id}}" @if($urole->role_id==$data->role) selected @endif>{{$urole->role_name}}</option>
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
                  <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="pic" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id="img-upload"/>
                  </div>
                  <div class="col-md-2">
                    @if($data->photo!='')
                      <img class="img-thumbnail img100" src="{{asset('uploads/users/'.$data->photo)}}"/>
                    @else
                      <img class="img-thumbnail img100" src="{{asset('uploads/avatar/avatar-black.png')}}"/>
                    @endif
                  </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
