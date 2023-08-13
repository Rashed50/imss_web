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


      <form class="form-horizontal" id="employee-info-form" method="post" action="{{ route('update-employee.information') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Update Employee</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Employee Information</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <input type="hidden" name="id" value="{{ $data->EmplInfoId }}">
              <input type="hidden" name="oldPhoto" value="{{ $data->Photo }}">
              <div class="form-group row custom_form_group{{ $errors->has('emp_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Employee Name Here" class="form-control" id="emp_name" name="emp_name" value="{{ $data->Name }}">
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
                    <input type="text" placeholder="Input Father Name" class="form-control" id="FatherName" name="FatherName" value="{{ $data->FatherName }}">
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
                    <input type="text" placeholder="Input Mobile Number" class="form-control" name="mobile_no" value="{{ $data->ContactNumber }}">
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
                                  <option value="{{$div->DiviId}}" {{ $div->DiviId == $data->DiviId?'selected':'' }}>{{$div->DiviName}}</option>
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
                                    <option value="{{ $data->District->DistId }}">{{ $data->District->DistName }}</option>
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
                                    <option value="{{ $data->Thana->ThanId }}">{{ $data->Thana->ThanaName }}</option>
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
                                 <option value="{{ $data->Union->UnioId }}">{{ $data->Union->UnioName }}</option>
                               </select>


                                @if ($errors->has('UnioId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('UnioId') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>




                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $data->PostOffice }}" id="PostOffice" name="PostOffice" placeholder="Input Post Code">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="Village" name="Village" placeholder="Village Name" >{{ $data->Village }}</textarea>
                        </div>

                      </div>
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Joining Date:</label>
                  <div class="col-sm-4">
                    <input type="date" name="joining_date" class="form-control" max="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->JoinDate }}">
                  </div>
              </div>

              <!-- <div class="form-group row custom_form_group">
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
                  <div class="col-md-4">
                    <img src="{{ asset($data->Photo) }}" alt="No Photo" class="custom_image">
                  </div>
                  <div class="col-sm-3">
                      <img id='img-upload4' class="upload_image"/>
                  </div>
              </div> -->

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>
@endsection
