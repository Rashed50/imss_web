@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">IMSS</a>
    <span class="breadcrumb-item active">Company Info</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        
        <div class="col-lg-12">
            <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('company.update') : route('company.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Company Information</h3>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                  <div class="card-body card_form">

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                @if(Session::has('success'))
                                  <div class="alert alert-success alertsuccess" role="alert">
                                     <strong>Success!</strong> {{Session::get('success')}}
                                  </div>
                                @endif
                                @if(Session::has('success_up'))
                                  <div class="alert alert-success alertsuccess" role="alert">
                                     <strong>Success!</strong> {{Session::get('success_up')}}
                                  </div>
                                @endif
                                @if(Session::has('error'))
                                  <div class="alert alert-danger alerterror" role="alert">
                                     <strong>Opps!</strong> {{Session::get('error')}}
                                  </div>
                                @endif
                            </div>
                            
                        </div>
        
                        <!-- amar code -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row custom_form_group{{ $errors->has('CompTitle') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Company Title:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Company Title" class="form-control" id="CompTitle" name="CompTitle" value="{{(@$data)?@$data->CompTitle:old('CompTitle')}}" required>
                                      <input type="hidden" name="CompId" value="{{@$data->CompId ?? ''}}">
                                      @if ($errors->has('CompTitle'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('CompTitle') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row custom_form_group{{ $errors->has('BengleTitle') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Bengle Title:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Bengle Title" class="form-control" id="BengleTitle" name="BengleTitle" value="{{(@$data)?@$data->BengleTitle:old('BengleTitle')}}" required>
                                      @if ($errors->has('BengleTitle'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('BengleTitle') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('CompName') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Title" class="form-control" id="CompName" name="CompName" value="{{(@$data)?@$data->CompName:old('CompName')}}" required>
                                      @if ($errors->has('CompName'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('CompName') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('BengleName') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Bengle Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Bengle Name" class="form-control" id="BengleName" name="BengleName" value="{{(@$data)?@$data->BengleName:old('BengleName')}}" required>
                                      @if ($errors->has('BengleName'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('BengleName') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('ownerName') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Owner Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Owner Name" class="form-control" id="ownerName" name="ownerName" value="{{(@$data)?@$data->ownerName:old('ownerName')}}" required>
                                      @if ($errors->has('ownerName'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('ownerName') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('CompAddress') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Address:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Address" class="form-control" id="CompAddress" name="CompAddress" value="{{(@$data)?@$data->CompAddress:old('CompAddress')}}" required>
                                      @if ($errors->has('CompAddress'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('CompAddress') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('Mobile1') ? ' has-error' : '' }}">
                                    <label class="col-sm-3 control-label">Mobile 1:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" placeholder="Mobile1" class="form-control" id="Mobile1" name="Mobile1" value="{{(@$data)?@$data->Mobile1:old('Mobile1')}}" required>
                                      @if ($errors->has('Mobile1'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('Mobile1') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>

                            </div>
                                      
                            <div class="col-md-6">
                                    <div class="form-group row custom_form_group{{ $errors->has('Mobile2') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Mobile 2:<span class="req_star">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" placeholder="Mobile2" class="form-control" id="Mobile2" name="Mobile2" value="{{(@$data)?@$data->Mobile2:old('Mobile2')}}" required>
                                          @if ($errors->has('Mobile2'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('Mobile2') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="form-group row custom_form_group{{ $errors->has('TelPhone') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Tel Phone :<span class="req_star">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" placeholder="Tel Phone" class="form-control" id="TelPhone" name="TelPhone" value="{{(@$data)?@$data->TelPhone:old('TelPhone')}}" required>
                                          @if ($errors->has('TelPhone'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('TelPhone') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    </div>
                                    <div class="form-group row custom_form_group{{ $errors->has('Fax') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Fax:<span class="req_star">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" placeholder="Fax" class="form-control" id="Fax" name="Fax" value="{{(@$data)?@$data->Fax:old('Fax')}}" required>
                                          @if ($errors->has('Fax'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('Fax') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="form-group row custom_form_group{{ $errors->has('Website') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Website:<span class="req_star">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" placeholder="Website Link" class="form-control" id="Website" name="Website" value="{{(@$data)?@$data->Website:old('Website')}}" required>
                                          @if ($errors->has('Website'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('Website') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="form-group row custom_form_group{{ $errors->has('Email') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Email:<span class="req_star">*</span></label>
                                        <div class="col-sm-7">
                                          <input type="text" placeholder="Email Address" class="form-control" id="Email" name="Email" value="{{(@$data)?@$data->Email:old('Email')}}" required>
                                          @if ($errors->has('Email'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('Email') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="form-group row custom_form_group{{ $errors->has('Logo') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Logo :</span></label>
                                        <div class="col-sm-5">
                                         <input type="file" id="image" class="form-control" id="Logo" name="Logo">
                                            @if ($errors->has('Logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('Logo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                         <div class="pl-2">
                                            <img id="showImage" height="70" alt="">
                                         </div>
                                    </div>

                            </div>
                        </div>
                  </div>
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SUBMIT' }}</button>
                  </div>
            </div>
          </form>
        </div>
    </div>

   
    <!-- list -->
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>Company List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Company Title</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Mobile1</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allCom as $key=>$comp)
                                      <tr>
                                          <td>{{ $key+1 }}</td>
                                          <td>{{ $comp->CompTitle ??'' }}</td>
                                          <td>{{ $comp->CompName ??'' }}</td>
                                          <td>{{ $comp->CompAddress ??'' }}</td>
                                          <td>{{ $comp->Mobile1 ??'' }}</td>
                                          <td>
                                              <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                              <a href="{{ route('company.edit',$comp->CompId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
        </div>
    </div>
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->

 
@endsection
