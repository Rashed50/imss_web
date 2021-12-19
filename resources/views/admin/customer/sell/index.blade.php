@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
 
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>Payment List</h3>
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
                                 <strong>Successfully!</strong> delete customer information.
                              </div>
                            @endif

                            @if(Session::has('success_update'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> update customer information.
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
                                            <th>Customer id</th>
                                            <th>Name</th>
                                            <th>Trade No</th>
                                            <th>Vouchar No</th>
                                            <th>Sell Date</th>
                                            <th>LB Cost</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Due Payment</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                        $date=date('Y-m-d',strtotime(Carbon\Carbon::now()));
                                        @endphp
                                    	@foreach($allSell as $sell)
                                     	<tr>
                                     		<td>{{$sell->Customer->CustName ?? ''}}</td>
                                     		<td>{{$sell->Customer->TradeName ?? ''}}</td>
                                     		<td>{{$sell->VoucharNo}}</td>
                                     		<td>{{$sell->SellingDate}}</td>
                                     		<td>{{$sell->LabourCost}}</td>
                                     		<td>{{$sell->TotalAmount}}</td>
                                     		<td>{{$sell->PaidAmount}}</td>
                                     		<td>{{$sell->DueAmount}}</td>

                                             <td>
                                                <a href="{{ route('payment.info.view',$sell->CustPaymId) }}" title="edit"><i class="fas fa-edit fa-lg edit_icon"></i></a>
                                                @if($payment->PaymentDate== $date)
                                                <a href="#" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
                                                @endif
                                                
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
