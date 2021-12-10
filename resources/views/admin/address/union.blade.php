@extends('layouts.admin')
@section('content')

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Union</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('union.update') : route('union.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
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
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Union Information</h3>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                  <div class="card-body card_form">

                    <div class="form-group row custom_form_group{{ $errors->has('DiviId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Division Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" id="DiviId" name="DiviId">
                              <option value="">Select Division</option>
                              @foreach($Division as $div)
                              <option value="{{$div->DiviId}}" {{(@$data->DiviId==$div->DiviId)?'selected': ''}}>{{$div->DiviName}}</option>
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
                        <label class="col-sm-3 control-label">District:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="DistId" id="DistId">
                                <option value="">Select District</option>
                                <option value="{{@$data->DistId}}">{{@$data->District->DistName ??''}}</option>
                            </select>
                            @if ($errors->has('DistId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('DistId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ThanId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Thana:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="ThanId" id="ThanId">
                                <option value="">Select Thana</option>
                                <option value="{{@$data->ThanId}}">{{@$data->Thana->ThanaName ??''}}</option>
                            </select>
                            @if ($errors->has('ThanId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ThanId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
 
                    <div class="form-group row custom_form_group{{ $errors->has('UnioName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Union Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Union Name" class="form-control" id="UnioName" name="UnioName" value="{{(@$data)?@$data->UnioName:old('UnioName')}}">
                          <input type="hidden" name="UnioId" value="{{@$data->UnioId ?? ''}}">
                          @if ($errors->has('UnioName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('UnioName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                  </div>
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SAVE' }}</button>
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
                            <h3 class="card-title card_top_title"></i>Union List</h3>
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
                                            <th>Division</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Union</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($allUnion as $key=>$union)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $union->Division->DiviName ??'' }}</td>
                                            <td>{{ $union->District->DistName ??'' }}</td>
                                            <td>{{ $union->Thana->ThanaName ??'' }}</td>
                                            <td>{{ $union->UnioName ??'' }}</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('union.edit',$union->DistId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
