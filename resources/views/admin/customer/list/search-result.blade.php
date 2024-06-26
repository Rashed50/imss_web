@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->


  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('customer.list.search.result') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title"> Customer Searching</h3>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>

                   @include('layouts.includes.customer-text')

                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">SEARCH</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- list -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                                <table id="dtHorizontalExample" class="table table-striped table-bordered custom_table table-sm mb-0" cellspacing="0"width="100%">
                                <thead>
                                         <tr>
                                            <th>SL NO.</th>
                                            <th>Customer</th>
                                            <th>Father</th>
                                            <th>TradeName</th>
                                            <th>ContactNumber</th>
                                            <th>Address</th>
                                            <th>DueAmount</th>
                                            <th>Photo</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $customer->CustName ??'' }}</td>
                                            <td>{{ $customer->FatherName ??'' }}</td>
                                            <td>{{ $customer->TradeName ??'' }}</td>
                                            <td>{{ $customer->ContactNumber ??'' }}</td>
                                            <td>{{ $customer->Address ??'' }}</td>
                                            <td>{{ $customer->DueAmount ??'' }}</td>
                                            <td>
                                                <img height="40" src="{{ asset($customer->Photo) }}" alt="">
                                            </td>

                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('customer.edit',$customer->CustId) }}" title="edit"><i class="fab fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->
@endsection
