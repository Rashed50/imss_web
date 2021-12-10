
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
                            <h3 class="card-title card_top_title"></i>Customer List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                	<div style="color: black; margin-left: 40px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;"  class="row mt-2 pt-2">
                       <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label> 
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CreditType" checked id="Retailer" value="Retailer">
                            <label class="form-check-label" for="Retailer">Retailer</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CreditType" id="Holeseller">
                            <label class="form-check-label" for="Holeseller">Holeseller</label>
                          </div>
                        </div>
                      </div>
                    <div class="row" id="HolesellerInfo" >
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
                                            <th>LB Cost</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Due Payment</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     	@foreach($seller as $sell)
                                     	<tr>
                                     		<td>SL NO</td>
                                     		<td>HolesellerInfo</td>
                                     		<td>{{$sell->Customer->CustName ?? ''}}</td>
                                     		<td>{{$sell->Customer->TradeName ?? ''}}</td>
                                     		<td>{{$sell->VoucharNo}}</td>
                                     		<td>{{$sell->SellingDate}}</td>
                                     		<td>{{$sell->LabourCost}}</td>
                                     		<td>{{$sell->TotalAmount}}</td>
                                     		<td>{{$sell->PaidAmount}}</td>
                                     		<td>{{$sell->DueAmount}}</td>
                                     	</tr>
                                     	@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                     <div class="row d-none" id="RetailerInfo">
                        <div class="col-12">
                            <div class="table-responsive">
                        		<table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>

                                            <th>SL NO.</th>
                                            <th>HolesellerInfo</th>
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
                                    	@foreach($seller as $sell)
                                     	<tr>
                                     		<td>SL NO</td>
                                     		<td>HolesellerInfo</td>
                                     		<td>{{$sell->Customer->CustName ?? ''}}</td>
                                     		<td>{{$sell->Customer->TradeName ?? ''}}</td>
                                     		<td>{{$sell->VoucharNo}}</td>
                                     		<td>{{$sell->SellingDate}}</td>
                                     		<td>{{$sell->LabourCost}}</td>
                                     		<td>{{$sell->TotalAmount}}</td>
                                     		<td>{{$sell->PaidAmount}}</td>
                                     		<td>{{$sell->DueAmount}}</td>
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
  

  <script type="text/javascript">
      $(document).on('click', '#Holeseller', function(){
        $('#RetailerInfo').removeClass('d-none');
        $('#HolesellerInfo').addClass('d-none');
      });

      $(document).on('click', '#Retailer', function(){
        $('#RetailerInfo').addClass('d-none');
        $('#HolesellerInfo').removeClass('d-none');
        
      });

  </script>

@endsection
