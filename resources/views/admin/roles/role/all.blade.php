@extends('layouts.admin-master')
@section('title') Create Role @endsection
@section('content')
<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title"> User Role</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active"> Role</li>
        </ol>
    </div>
</div>
<!-- add division -->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_add'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Added New Role.
          </div>
        @endif
        @if(Session::has('success_update'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Role.
          </div>
        @endif
        @if(Session::has('success_error'))
          <div class="alert alert-warning alerterror" role="alert">
             <strong>Opps!</strong> please try again.
          </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <form class="form-horizontal" action="{{ route('role-manage.store') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body card_form" style="padding-top: 0;">
              <div class="form-group row custom_form_group{{ $errors->has('role_name') ? ' has-error' : '' }}" style="margin-bottom: 0">
                  <label class="control-label col-md-3">Role Name:<span class="req_star">*</span></label>
                  <div class="col-md-7">
                    <input type="text" placeholder="Input Role Name" class="form-control keyup-characters" name="role_name" value="{{old('role_name')}}">
                    @if ($errors->has('role_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
            </div>
        </div>
      </form>
    </div>
    <div class="col-md-3"></div>
</div>

<!-- division list -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-lg-10">
      <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-md-8">
                      <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> User Role</h3>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-12">
                      <div class="table-responsive">
                          <table id="alltableinfo" class="table table-bordered custom_table mb-0">
                              <thead>
                                  <tr>
                                      <th>SL No</th>
                                      <th>Role Name</th>
                                      <th>Manage</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($all as $item)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->role_name }}</td>
                                    <td>
                                      <a href="{{ route('role-manage.edit',$item->role_auto_id) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon"></i></a>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-md-1"></div>
</div>

@endsection
