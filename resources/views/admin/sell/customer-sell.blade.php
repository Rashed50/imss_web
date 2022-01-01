@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">IMSS</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
     <div class="row">
        <div class="col-md-12 text-center">
            <h6>Searching Product Sales Customer</h6>
        </div>
    </div>
    <br>
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('customer.type-wise.sell-details.search') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  @include('layouts.includes.customer-search')
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
                            <h3 class="card-title card_top_title"></i>Salse Customer List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                            <table id="dtHorizontalExample" class="custom_table table table-striped table-bordered table-sm mb-0" cellspacing="0"width="100%">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Trade</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td>{{substr($customer->CustomerType->TypeName,0,1) }}</td>
                                            <td>{{ $customer->CustName ??'' }}</td>
                                            <td>{{ $customer->TradeName ??'' }}</td>
                                            <td>{{ $customer->ContactNumber ??'' }}</td>
                                            <td>{{ $customer->Address ??'' }}</td>
                                            <td>{{ $customer->DueAmount ??'' }}</td>
                                            <td>
                                             <a class="btn btn-md btn-success waves-effect" href="{{ route('customer.wise.sell.info',$customer->CustId ) }}" title="Sell Details"> <i class="fa fa-balance-scale" aria-hidden="true"></i> <i class="fa fa-database" aria-hidden="true"></i> </a>
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
