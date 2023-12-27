@extends('layouts.admin')
@section('title') Role @endsection
@section('content')

 
<!-- Session Message -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if(Session::has('success'))
          <div class="alert alert-success alertsuccess" role="alert">
                <strong> {{Session::get('success')}}</strong>
          </div>
        @endif
        @if(Session::has('error'))
          <div class="alert alert-warning alerterror" role="alert">
             <strong> {{Session::get('error')}}</strong>
          </div>
        @endif
    </div>
    <div class="col-md-1"></div>
</div>

<!-- User list -->
<div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
                <div class="row">
                  <div class="col-md-6">
                      <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Role List</h3>
                  </div>

                  <div class="col-md-6 text-right">
                    <a href="{{ route('role.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create New Role</a>
                    <a data-toggle="modal" data-target="#new_permission_modal" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create New Permission</a>

                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-12">
                      <div class="table-responsive">
                          <table id="alltableinfo" class="responsive table table-bordered custom_table mb-0">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Name</th>
                                      <th>Manage</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($roles as $key => $role)
                                  <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('user_role_edit')
                                                <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a>
                                        @endcan
                                        {{-- <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a> --}}

                                        <br>

                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                          {!! $roles->render() !!}
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

<!-- Modal For Create Permission -->
 <div class="modal fade" id="new_permission_modal" tabindex="-1" role="dialog" aria-labelledby="new_permission_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Insertion of New Permission  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('permission.create') }}">
                    @csrf
                    <div class="form-group row custom_form_group{{ $errors->has('permission_name') ? ' has-error' : '' }}" style="margin-bottom: 0">
                        <label class="control-label col-md-4">Name:<span class="req_star">*</span></label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Input Permision Name" class="form-control keyup-characters" id="permission_name" name="permission_name"   required>
                        </div>
                    </div><br>

                    <button type="submit"  id="onSubmit" class="btn btn-primary waves-effect">SAVE</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
