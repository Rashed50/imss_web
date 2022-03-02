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
            <form class="form-horizontal" id="registration" method="post" action="{{ route('CreitVoucher.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Credit Information</h3>
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

                        <div style="color: black; margin-left: 40px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;" class="row {{ $errors->has('CreditType') ? ' has-error' : '' }} mt-2 pt-2">
                            <label class="col-sm-3 control-label">Credit Type:<span class="req_star">*</span></label>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" id="Employee" value="1" checked {{(@$data->CreditType=='1')? 'checked':''}}>
                                    <label class="form-check-label" for="Employee">Employee</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" id="Transaction" value="2" {{(@$data->CreditType=='2')? 'checked':''}}>
                                    <label class="form-check-label" for="Transaction">Transaction</label>
                                </div>
                            </div>
                            @if ($errors->has('CreditType'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('CreditType') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div id="EmployeeName" class="form-group row custom_form_group{{ $errors->has('EmployeeName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Employee Name:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <select name="EmployeeName" class="form-control">
                                    <option>Select Employee</option>
                                    @foreach($getAllEmployees as $employee)
                                    <option value="{{$employee->EmplInfoId}}">{{$employee->Name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('EmployeeName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('EmployeeName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="TranPurpose" class=" d-none form-group row custom_form_group{{ $errors->has('CrTypeId') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Transaction Purpose:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <select name="CrTypeId" class="form-control">
                                    <option>Select Purpose</option>
                                    @foreach($TType as $type)
                                    <option value="{{$type->CrTypeId}}" {{ @$data->CrTypeId==$type->CrTypeId ? 'selected' : ''}}>{{$type->CrTypeName}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('CrTypeId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CrTypeId') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                ADD
                            </button>
                        </div>
                        
                        <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Vouchar No:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Vouchar No" class="form-control" id="VoucharNo" name="VoucharNo" value="{{(@$data)?@$data->VoucherId:old('VoucharNo')}}" required>
                                @if ($errors->has('VoucharNo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('VoucharNo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('Amount') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Amount :</label>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Amount" class="form-control" id="Amount" name="Amount" value="{{(@$data)?@$data->Amount:old('Amount')}}" required>
                                @if ($errors->has('Amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Amount') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('Date') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Date:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="datepicker" name="Date" value="{{(@$data)? date('Y-m-d',strtotime(@$data->ExpenseDate)):date('Y-m-d',strtotime(Carbon\Carbon::now())) }}" required autocomplete="off">
                                @if ($errors->has('Date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('Credited') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Credited From :</label>
                            <div class="col-sm-7">
                                <select name="Credited" class="form-control">
                                    <option>Select Credited</option>
                                    <option value="1">Credited 1</option>
                                    <option value="2">Credited 2</option>
                                    <option value="3">Credited 3</option>
                                    <option value="4">Credited 4</option>
                                </select>
                                @if ($errors->has('Credited'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Credited') }}</strong>
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
                            <h3 class="card-title card_top_title"></i>Credit List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Transaction Name</th>
                                            <th>CrType</th>
                                            <th>ExpenseDate</th>
                                            <th>Amount</th>
                                            <th>DebitedTold</th>
                                            <th>CreditedFromId</th>
                                            <th>VoucherId</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allDrVouchar as $key=> $vouchar)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$vouchar->TransactionId}}</td>
                                            <td>{{$vouchar->CrTypeId}}</td>
                                            <td>{{$vouchar->ExpenseDate}}</td>
                                            <td>{{$vouchar->Amount}}</td>
                                            <td>{{$vouchar->DebitedTold}}</td>
                                            <td>{{$vouchar->CreditedFromId}}</td>
                                            <td>{{$vouchar->VoucherId}}</td>
                                            <td>
                                                <a href="{{ route('CreitVoucher.edit',$vouchar->CrVoucId) }}" title="edit"><i class="fas fa-edit fa-lg edit_icon"></i></a>
                                                <a href="{{ route('CreitVoucher.delete',$vouchar->CrVoucId) }}" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:600px!important">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">credit Type Add</h6>

            </div>
            <div class="modal-body pd-20">
                <form action="{{route('credit.type.store')}}" method="post">
                    @csrf
                    <div class="form-group row custom_form_group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="credit Type Name" class="form-control" name="CrTypeName" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


<script type="text/javascript">
    $(document).on('click', '#Transaction', function() {
        $('#TranPurpose').removeClass('d-none');
        $('#EmployeeName').addClass('d-none');
    });

    $(document).on('click', '#Employee', function() {
        $('#TranPurpose').addClass('d-none');
        $('#EmployeeName').removeClass('d-none');

    });
</script>

@endsection