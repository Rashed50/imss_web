@extends('layouts.admin')
@section('title') Update Role @endsection
  @section('internal-css')
    <link href="{{ asset('contents/admin') }}/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
  @endsection
@section('content')

{{-- <div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title"> Role Update</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active"> Role Update</li>
        </ol>
    </div>
</div> --}}

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
        {{-- {!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!} --}}
      <form class="form-horizontal" id="role_update" method="POST" action="{{ route('role.update') }}">
          @csrf

          <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Role</h3>
                      </div>
                      <div class="col-md-4 text-right">
                          {{-- <a href="{{ route('users.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Role</a> --}}
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="card-body card_form">
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" hidden id="id" name="id" value="{{$role->id}}">
                          <label class="col-md-6 control-label">Role Name:<span class="req_star">*</span></label>
                          <input type="text" class="col-md-6" name="name" value="{{$role->name}}">
                      </div>
                    </div>
                    {{-- permission --}}
                    <div class="col-md-8">                   
                      <div class="table-responsive">
                          <table id="alltableinfo" class="table table-bordered table-hover custom_table mb-0">
                              <thead>
                                  <tr>
                                      <th>Permission </th>
                                      <th>Action </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($permission as $value)
                                  <tr>
                                      <td>
                                          {{ $value->name }} 
                                      </td>
                                      <td>  
                                          <input type="hidden" name="permission[]" value="{{$value->id}}">                                                 
                                          <input type="checkbox" name="checkbox-{{$value->id}}" id="checkbox-{{$value->id}}" checked ="{{ in_array($value->id, $rolePermissions) ? true:false  }}"  value="0">                                                  
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                    </div>
                </div>

              </div>
              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">Update</button>
              </div>
          </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function checkRole(){

    }
</script>
@endsection
