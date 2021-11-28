@extends('layouts.admin')
@section('employee') show-sub active @endsection
@section('add-employee') active @endsection
@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="#">IMSS</a>
  <span class="breadcrumb-item active">Dashboard</span>
</nav>

<div class="sl-pagebody">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">


      <form class="form-horizontal" id="employee-info-form" method="post" action="{{ route('store-employee.information') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> New Employee Details</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Employee Information</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('emp_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Employee Name Here" class="form-control" id="emp_name" name="emp_name" value="{{old('emp_name')}}">
                    @if ($errors->has('emp_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('emp_name') }}</strong>
                        </span>
                    @endif
                    <div id="showerror1"></div>
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('FatherName') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Father Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Father Name" class="form-control" id="FatherName" name="FatherName" value="{{old('FatherName')}}">
                    @if ($errors->has('FatherName'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('FatherName') }}</strong>
                        </span>
                    @endif
                    <div id="showerror1"></div>
                  </div>
              </div>


              <div class="form-group row custom_form_group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Mobile No:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Mobile Number" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" unique>
                    @if ($errors->has('mobile_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile_no') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>


              <div class="row custom_form_group">
                  <label class="col-sm-3 control-label">Designation:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <div class="form{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                        <select class="form-control" name="designation_id">
                            <option value="">Select Designation</option>
                            <option value="1">Manager</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Computer Operator</option>
                            <option value="4">Unskill</option>
                        </select>
                    </div>
                  </div>
              </div>


              <div class="row custom_form_group" style="align-items: start">
                  <label class="col-sm-3 control-label">Parmanent Address:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                      <div class="parmanent_address">


                        <div class="form-group row custom_form_group{{ $errors->has('DiviId') ? ' has-error' : '' }}">
                            <div class="col-sm-12">
                              <select class="form-control" id="DiviId" name="DiviId">
                                  <option value="">Select Division</option>
                                  @foreach($Division as $div)
                                  <option value="{{$div->DiviId}}">{{$div->DiviName}}</option>
                                  @endforeach
                              </select>
                              @if ($errors->has('DiviId'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('DiviId') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
                            <div class="col-sm-12">

                                <select class="form-control" name="DistId" id="DistId">
                                    <option value="">Select District</option>
                                </select>
                                @if ($errors->has('DistId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('DistId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('ThanId') ? ' has-error' : '' }}">
                            <div class="col-sm-12">

                                <select class="form-control" name="ThanId" id="ThanId">
                                    <option value="">Select Thana</option>
                                </select>
                                @if ($errors->has('ThanId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ThanId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row custom_form_group{{ $errors->has('UnioId') ? ' has-error' : '' }}">
                             <div class="col-sm-12">

                               <select class="form-control" name="UnioId" id="UnioId">
                                 <option value="">Select Union</option>
                               </select>


                                @if ($errors->has('UnioId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('UnioId') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>




                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ old('PostOffice') }}" id="PostOffice" name="PostOffice" placeholder="Input Post Code">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="Village" name="Village" placeholder="Village Name" >{{ old('Village') }}</textarea>
                        </div>

                      </div>
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Joining Date:</label>
                  <div class="col-sm-4">
                    <input type="date" name="joining_date" class="form-control" max="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="<?= date("Y-m-d") ?>">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Profile Photo:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="profile_photo" id="imgInp4">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-sm-3">
                      <img id='img-upload4' class="upload_image"/>
                  </div>
              </div>

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
            </div>
        </div>
      </form>



    </div>
    <div class="col-md-2"></div>
  </div>
  {{-- Employee information --}}
  <div class="row" style="margin-top: 20px">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
              <table id="datatable1" class="table responsive mb-0">
                  <thead>
                      <tr>
                          <th>SL</th>
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Mobile No</th>
                          <th>Join Date</th>
                          <th>Address</th>
                          <th>Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($getAllEmployees as $employee)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            <img src="{{ asset($employee->Photo) }}" alt="No Photo" class="custom_image">
                          </td>
                          <td>{{ $employee->Name }}</td>
                          <td>{{ $employee->ContactNumber }}</td>
                          <td>{{ $employee->JoinDate }}</td>
                          <td>{{ $employee->Division->DiviName }},{{ $employee->District->DistName }}</td>
                          <td>
                              <a href="{{ route('employee.edit',$employee->EmplInfoId) }}" title="edit"><i class="fas fa-edit fa-lg edit_icon"></i></a>
                              <a href="#" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
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
  {{-- Employee information --}}
</div>
@endsection
