@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Vendor</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-4" style="border: 1px solid black;">

            <div class="row">
                <div class="col-md-12" style="border: 1px solid black;">
                <div class="form-group row custom_form_group{{ $errors->has('TradeName') ? ' has-error' : '' }}">
                    <label class="col-sm-5 control-label">Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" name="TradeName">
                        <option value="">Select Name</option>
                        
                        </select>
                        @if ($errors->has('TradeName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('TradeName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row custom_form_group{{ $errors->has('Date') ? ' has-error' : '' }}">
                    <label class="col-sm-4 control-label">Date:<span class="req_star">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="datepicker" name="Date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}">
                        @if ($errors->has('Date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                </div>
                <div class="col-md-12" style="border: 1px solid black;">
                <div class="form-group row custom_form_group{{ $errors->has('TradeName') ? ' has-error' : '' }}">
                    <label class="col-sm-5 control-label">Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" name="TradeName">
                        <option value="">Select Name</option>
                        
                        </select>
                        @if ($errors->has('TradeName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('TradeName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row custom_form_group{{ $errors->has('Date') ? ' has-error' : '' }}">
                    <label class="col-sm-4 control-label">Date:<span class="req_star">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="datepicker" name="Date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}">
                        @if ($errors->has('Date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row custom_form_group{{ $errors->has('Date') ? ' has-error' : '' }}">
                    <label class="col-sm-4 control-label">Date:<span class="req_star">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="datepicker" name="Date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}">
                        @if ($errors->has('Date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                </div>
                
                

            </div>
        </div>
        <div class="col-lg-8" style="border: 1px solid black;">
        <div class="row" >
            <div class="col-12">
                <div class="table-responsive">
                    <table id="datatable1" class="table responsive mb-0">
                        <thead>
                            <tr>

                                <th>SL NO.</th>
                                <th>RetailerInfo</th>
                                <th>Customer id</th>
                                <th>Name</th>
                                <th>Trade No</th>
                                <th>Sell Date</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
    </div>
    <!-- list -->
  
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->





@endsection
