@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('customer.search') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Customer Information</h3>
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
                        <div class="col-md-2"></div>
                    </div>

                    <div class="form-group row custom_form_group" style="align-items:center">
                        <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label>
                        <div class="col-sm-4">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="type" value="1" id="btnradio1" autocomplete="off" checked>
                            <label class="btn" for="btnradio1"> Whole Seller</label>

                            <input type="radio" class="btn-check" name="type" value="2" id="btnradio2" autocomplete="off">
                            <label class="btn" for="btnradio2">Retailer</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">District:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="DistId" id="DistId">
                                <option value="">Select District</option>
                                @foreach($allDistrict as $district)
                                <option value="{{$district->DistId}}">{{$district->DistName}}</option>
                                @endforeach
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

                  </div>
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">SEARCH</button>
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
                            <h3 class="card-title card_top_title"></i>Customer List</h3>
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
                                            <th>Customer type</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td>{{$customer->CustomerType->TypeName}}</td>
                                            <td>{{$customer->Distict->DistName}}</td>
                                            <td>{{$customer->Thana->ThanaName}}</td>
                                            <td>{{$customer->CustName}}</td>
                                            <td>{{$customer->ContactNumber}}</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="#" title="edit"><i class="fab fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
