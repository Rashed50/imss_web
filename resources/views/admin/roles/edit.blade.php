@extends('layouts.admin-master')
@section('title') Update New Role @endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title"> Role Update</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active"> Role Update</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-7">
        @if(Session::has('success'))
          <div class="alert alert-success alertsuccess" role="alert" style="margin-left: -20px">
             <strong>Successfully!</strong> Update New Role.
          </div>
        @endif
        @if(Session::has('error'))
          <div class="alert alert-warning alerterror" role="alert" style="margin-left: -20px">
             <strong>Opps!</strong> please try again.
          </div>
        @endif
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row">
    <div class="col-lg-12">
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
          @csrf

          <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Role</h3>
                      </div>
                      <div class="col-md-4 text-right">
                          <a href="{{ route('users.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Role</a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="card-body card_form">
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="control-label">Name:<span class="req_star">*</span></label>
                          <div class="">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                    </div>
                    {{-- permission --}}
                    <div class="col-md-8">
                      {{-- permission --}}
                      <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                          <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                          {{ $value->name }}</label>
                          <br/>
                        @endforeach
                       </div>
                      {{-- permission --}}
                    </div>
                </div>

              </div>
              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">Update</button>
              </div>
          </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
