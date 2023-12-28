@extends('layouts.admin')
@section('content')

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

<div class="row">
    <div class="col-12">
      <form method="post" action="{{route('user.update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update User Information</h4>
                    </div>                    
                </div>
            </div>
            <div class="card-body">
              
              <div class="form-group row mb-3 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="id" value="{{$data->id}}"/> 
                    <input type="text" class="form-control form_control" name="user_name" value="{{$data->user_name}}">
                    @if ($errors->has('user_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('user_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="user_phone" value="{{$data->user_phone}}">
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('user_email') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="user_email" value="{{$data->user_email}}">
                    @if ($errors->has('user_email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('user_email') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                  <div class="col-sm-4">
                   
                    <select class="form-control form_control" name="role">
                      <option value="">Choose Role</option>
                      @foreach($roles as $urole)
                      <option value="{{$urole->id}}"   >{{$urole->name}}</option>
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
