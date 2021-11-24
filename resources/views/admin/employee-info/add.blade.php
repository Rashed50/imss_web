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


      <form class="form-horizontal" id="employee-info-form" method="post" action="#" enctype="multipart/form-data">
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
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-7">
                      @if(Session::has('success'))
                        <div class="alert alert-success alertsuccess" role="alert" style="margin-left: -20px">
                           <strong>Successfully!</strong> Added New Employee information.
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
                        </select>
                    </div>
                  </div>
              </div>


              <div class="row custom_form_group" style="align-items: start">
                  <label class="col-sm-3 control-label">Parmanent Address:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                      <div class="parmanent_address">
                        <!-- division -->
                        <div class="form-group">
                            <select class="form-control" name="division_id">
                                <option value="">Select Division</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="district_id">
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="district_id">
                                <option value="">Select Thana</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="district_id">
                                <option value="">Select Union</option>
                            </select>
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
                <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">NEXT</button>
            </div>
        </div>
      </form>



    </div>
    <div class="col-md-2"></div>
  </div>
</div>
@endsection
