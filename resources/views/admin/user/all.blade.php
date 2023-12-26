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
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All User Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                      <a href="{{route('user.add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add User</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               
                <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                      <tr>
                           <th>S.N</th>
                          <th>User Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Photo</th>
                          <th>Manage</th>
                      </tr>                      
                    </thead>
                    <tbody>
                      @foreach ($users as $auser)
                        <tr>
                          <td>{{ $loop->iteration  }}</td>
                          <td>{{ $auser->user_name }}</td>
                          <td>{{ $auser->user_email }}</td>
                          <td>{{ $auser->user_phone }}</td>
                          <td>{{ $auser->status == 1 ? 'Active' : 'Inactive' }}</td>
                          <td>{{ $auser->profile_photo }}</td>
                          <td>
                              @can('user_edit')
                                      <a class="btn btn-primary" href="{{ route('user.edit',$auser->id) }}">Edit</a>
                              @endcan
                              <br>
                              <a class="btn btn-primary" href="{{ route('user.edit',$auser->id) }}">Edit w</a>

                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer card_footer">
              <div class="btn-group mt-2" role="group">
                  <a href="#" class="btn btn-secondary">Print</a>
                  <a href="#" class="btn btn-dark">PDF</a>
                  <a href="#" class="btn btn-secondary">Excel</a>
              </div>
            </div> --}}
        </div>
    </div>
</div>
<!--softdelete modal start-->
{{-- <div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{route('user-softdelete')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">
          Are you sure you want to delete?
          <input type="hidden" id="modal_id" name="modal_id">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
            <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div> --}}
@endsection
