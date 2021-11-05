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
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="#" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Vendor Information</h3>
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

                    <div class="form-group row custom_form_group{{ $errors->has('VendName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Vendor Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Vendor Name" class="form-control" id="VendName" name="VendName" value="{{(@$data)?@$data->VendName:old('VendName')}}" required>
                          @if ($errors->has('VendName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('VendName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ContactName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Contact Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Contact Name" class="form-control" id="ContactName" name="ContactName" value="{{(@$data)?@$data->ContactName:old('ContactName')}}" required>
                          @if ($errors->has('ContactName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ContactName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('Mobile1') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Mobile No.:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Mobile No." class="form-control" id="Mobile1" name="Mobile1" value="{{(@$data)?@$data->Mobile1:old('Mobile1')}}" required>
                          @if ($errors->has('Mobile1'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Mobile1') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('OpeningDate') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Opening Date:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Opening Date" class="form-control" id="datepicker" name="OpeningDate" value="{{(@$data)?@$data->OpeningDate:old('OpeningDate')}}" required>
                          @if ($errors->has('OpeningDate'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('OpeningDate') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('Balance') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Balance :<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Balance" class="form-control" id="Balance" name="Balance" value="{{(@$data)?@$data->Balance:old('Balance')}}" required>
                          @if ($errors->has('Balance'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Balance') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('InitialBalance') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Initial Balance:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Initial Balance" class="form-control" id="InitialBalance" name="InitialBalance" value="{{(@$data)?@$data->InitialBalance:old('InitialBalance')}}" required>
                          @if ($errors->has('InitialBalance'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('InitialBalance') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ChartOfAcctId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Accountant :<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Accountant" class="form-control" id="ChartOfAcctId" name="ChartOfAcctId" value="{{(@$data)?@$data->ChartOfAcctId:old('ChartOfAcctId')}}" required>
                          @if ($errors->has('ChartOfAcctId'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ChartOfAcctId') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('VendAddress') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Vendor Address :<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Vendor Address" class="form-control" id="VendAddress" name="VendAddress" value="{{(@$data)?@$data->VendAddress:old('VendAddress')}}" required>
                          @if ($errors->has('VendAddress'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('VendAddress') }}</strong>
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
                            <h3 class="card-title card_top_title"></i>Vendor List</h3>
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
                                 <strong>Successfully!</strong> delete Vendor information.
                              </div>
                            @endif

                            @if(Session::has('success_update'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> update Vendor information.
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
                                            <th>Vendor Name</th>
                                            <th>Contact Name</th>
                                            <th>Mobile</th>
                                            <th>Opening Date</th>
                                            <th>Balance</th>
                                            <th>Initial Balance</th>
                                            <th>Accountant</th>
                                            <th>Address</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($allVendor as $key=>$vendor)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $vendor->VendName ??'' }}</td>
                                            <td>{{ $vendor->ContactName ??'' }}</td>
                                            <td>{{ $vendor->Mobile1 ??'' }}</td>
                                            <td>{{ $vendor->OpeningDate ??'' }}</td>
                                            <td>{{ $vendor->Balance ??'' }}</td>
                                            <td>{{ $vendor->InitialBalance ??'' }}</td>
                                            <td>{{ $vendor->ChartOfAcctId ??'' }}</td>
                                            <td>{{ $vendor->VendAddress ??'' }}</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('vendor.edit',$vendor->VendId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
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




 <script>
    $( function() {
        $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        });
    } );
</script>
@endsection
