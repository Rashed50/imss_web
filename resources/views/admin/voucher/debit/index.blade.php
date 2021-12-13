@extends('layouts.admin')
@section('Voucher') show-sub active @endsection
@section('debit-voucher') active @endsection
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
  {{-- Response Massage --}}
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
  {{-- Response Massage --}}


  {{-- Add Modal --}}

  <div id="AddNewVoucher" class="modal fade">
    <div class="modal-dialog modal-lg" role="document" style="width:600px!important">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Debit Voucher Information</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">

              <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                <form class="" action="{{ route('DebitVoucher.store') }}" method="post">
                    @csrf
                  {{-- input element --}}
                  <div class="form-group row custom_form_group{{ $errors->has('Purpose') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Purpose:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <select class="form-control" name="Purpose" required>
                          <option value="">Select Purpose</option>
                          @foreach($TType as $type)
                          <option value="{{$type->DrTypeId}}">{{$type->DrTypeName}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('Purpose'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Purpose') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('DebitedTo') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Debited To:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <select class="form-control" name="DebitedTo" required>
                          <option value="">Select Here</option>
                          <option value="1">1 Here</option>
                          <option value="2">2 Here</option>
                        </select>
                        @if ($errors->has('DebitedTo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('DebitedTo') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Vouchar No:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="text" placeholder="VoucharNo" class="form-control" id="VoucharNo" name="VoucharNo" value="{{ old('VoucharNo') }}" required>
                      @if ($errors->has('VoucharNo'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('VoucharNo') }}</strong>
                          </span>
                      @endif
                      </div>
                  </div>
                  <div class="form-group row custom_form_group{{ $errors->has('Amount') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Amount:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="text" placeholder="Amount" class="form-control" id="Amount" name="Amount" value="{{ old('Amount') }}" required>
                      @if ($errors->has('Amount'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Amount') }}</strong>
                          </span>
                      @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group {{ $errors->has('Date') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Date:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="date" class="form-control" name="Date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      @if ($errors->has('Date'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Date') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('CreditedFromId') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Creditted From:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <select class="form-control" name="CreditedFromId" required>
                          <option value="">Select Here</option>
                          <option value="1"> Here 1</option>
                          <option value="2"> Here 2</option>
                        </select>
                        @if ($errors->has('CreditedFromId'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('CreditedFromId') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- input element --}}
                
              </div>
            </div>
            <!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">SAVE</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Cencel</button>
            </div>
            </form>
        </div>
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:600px!important">
      <div class="modal-content tx-size-sm">
         <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Debit Type Add</h6>
                
            </div>
        <div class="modal-body pd-20">
            <form action="{{route('debit.type.store')}}" method="post">
                @csrf
                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-7">
                    <input type="text" placeholder="debit Type Name" class="form-control" name="DrTypeName" required>
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
  {{-- end Modal --}}


    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title card_top_title"></i>Vouchar List</h3>
                        </div>
                        <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus-circle mr-2"></i> ADD </button>
                        <button class="btn btn-md btn-primary waves-effect card_top_button" data-toggle="modal" data-target="#AddNewVoucher"><i class="fa fa-plus-circle mr-2"></i>Add New Banner</button>
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
                                            <th>Transaction Name</th>
                                            <th>DrType</th>
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
                                         <td>{{$vouchar->DrTypeId}}</td>
                                         <td>{{$vouchar->ExpenseDate}}</td>
                                         <td>{{$vouchar->Amount}}</td>
                                         <td>{{$vouchar->DebitedTold}}</td>
                                         <td>{{$vouchar->CreditedFromId}}</td>
                                         <td>{{$vouchar->VoucherId}}</td>
                                         <td>
                                            <a href="#" title="edit"><i class="fas fa-edit fa-lg edit_icon" data-toggle="modal" data-target="#AddNewVoucher" id="{{$vouchar->DrVoucId}}"  onclick="updateDrVouchar(this.id)"></i></a>
                                            <a href="{{ route('DebitVoucher.delete',$vouchar->DrVoucId) }}" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
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


@endsection
