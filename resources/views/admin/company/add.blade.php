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
                    <div class="form-group row custom_form_group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Company Title:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="title" name="title" value="{{(@$data)?@$data->CompTitle:old('title')}}" required>
                          <input type="hidden" name="CompId" value="{{@$data->CompId ?? ''}}">
                          @if ($errors->has('title'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('title') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('bengleTitle') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Bengle Title:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="bengleTitle" name="bengleTitle" value="{{(@$data)?@$data->BengleTitle:old('bengleTitle')}}" required>
                          @if ($errors->has('bengleTitle'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('bengleTitle') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="name" name="name" value="{{(@$data)?@$data->CompName:old('name')}}" required>
                          @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('bengleName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Bengle Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="bengleName" class="form-control" id="bengleName" name="bengleName" value="{{(@$data)?@$data->BengleName:old('bengleName')}}" required>
                          @if ($errors->has('bengleName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('bengleName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Address:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="address" class="form-control" id="address" name="address" value="{{(@$data)?@$data->CompAddress:old('address')}}" required>
                          @if ($errors->has('address'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('address') }}</strong>
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

                    <div class="form-group row custom_form_group{{ $errors->has('Mobile3') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Mobile 3:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="Mobile3" name="Mobile3" value="{{(@$data)?@$data->Mobile3:old('Mobile3')}}" required>
                          @if ($errors->has('Mobile3'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Mobile3') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Website') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Website:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="Website" name="Website" value="{{(@$data)?@$data->Website:old('Website')}}" required>
                          @if ($errors->has('Website'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Website') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Mobile3') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Email:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Title" class="form-control" id="Email" name="Email" value="{{(@$data)?@$data->Email:old('Email')}}" required>
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
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SUBMIT' }}</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
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
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if(Session::has('success_soft'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> delete company information.
                              </div>
                            @endif

                            @if(Session::has('success_update'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> update company information.
                              </div>
                            @endif

                            @if(Session::has('error'))
                              <div class="alert alert-warning alerterror" role="alert">
                                 <strong>Opps!</strong> please try again.
                              </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    
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
