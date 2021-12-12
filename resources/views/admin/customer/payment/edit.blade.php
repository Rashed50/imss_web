@extends('layouts.admin')
@section('customer') show-sub active @endsection
@section('customer.payment') active @endsection
@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="#">IMSS</a>
  <span class="breadcrumb-item active">Dashboard</span>
</nav>

<div class="sl-pagebody">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">


      <form class="form-horizontal" id="employee-info-form" method="post" action="{{ route('update-customer.payment') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> New Employee Details</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Employee Information</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <input type="hidden" name="id" value="{{ $data->CustPaymId }}">
              <div class="form-group row custom_form_group" style="align-items:center">
                  <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label>
                  <div class="col-sm-4">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" onclick="holeseller()">
                      <label class="btn" for="btnradio1"> Whole Seller</label>

                      <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" onclick="retailer()">
                      <label class="btn" for="btnradio2">Retailer</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <p style="margin-bottom:0"> <strong>Current Due:</strong> <span id="CurrentDue">  </span> </p>
                  </div>
              </div>



              <div class="form-group row custom_form_group{{ $errors->has('Customer') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Customer:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="Customer">
                        <option value="{{ $data->Customer->CustId }}">{{ $data->Customer->CustName }}</option>
                    </select>

                    @if ($errors->has('Customer'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Customer') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <input type="hidden" name="CurrentDue" id="CurrentDue" value="">
              <div class="form-group row custom_form_group{{ $errors->has('PayAmount') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Pay Amount:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Amount" class="form-control" name="PayAmount" value="{{ $data->PaymentAmount }}">
                    @if ($errors->has('PayAmount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('PayAmount') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Discount:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Amount" class="form-control" name="Discount" value="{{ $data->Discount }}">
                    @if ($errors->has('Discount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Discount') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Vouchar No:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Vouchar No" class="form-control" name="VoucharNo" value="{{ $data->VoucharNo }}">
                    @if ($errors->has('VoucharNo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('VoucharNo') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('MoneyReciveBy') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Money Recive By:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="MoneyReciveBy">
                      <option value="">Select Here</option>
                      @foreach ($employee as $emp)
                        <option value="{{ $emp->EmplInfoId }}" {{ $emp->EmplInfoId == $data->MoneyReciveBy ? 'selected' : '' }}>{{ $emp->Name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('MoneyReciveBy'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('MoneyReciveBy') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('AccountId') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label"> Account:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="AccountId">
                      <option value="">Select Here</option>
                      <option value="1" selected>Account 01</option>
                      <option value="2">Account 02</option>
                    </select>

                    @if ($errors->has('AccountId'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('AccountId') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('PaymentDate') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label"> Date:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="date" class="form-control" name="PaymentDate" value="{{ $data->PaymentDate }}">

                    @if ($errors->has('PaymentDate'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('PaymentDate') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
    <div class="col-md-2"></div>
  </div>

  {{-- Employee information --}}
  <div class="row" style="margin-top: 20px">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
              <table id="datatable1" class="table responsive mb-0">
                  <thead>
                      <tr>
                          <th>SL</th>
                          <th>Date</th>
                          <th>Customer Name</th>
                          <th>Payment</th>
                          <th>Discount</th>
                          <th>Money Recive</th>
                          <th>Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($getAllPaymentCustomer as $data)
                      <tr>
                       <td>{{ $loop->iteration }}</td>
                       <td>{{ $data->PaymentDate }}</td>
                       <td>{{ $data->Customer->CustName ?? ''}}</td>
                       <td>{{ $data->PaymentAmount }}</td>
                       <td>{{ $data->Discount }}</td>
                       <td>{{ $data->Employee->Name ?? '' }}</td>
                       <td>
                         <a href="{{ route('customer.payment-edit',$data->CustPaymId ) }}" title="edit"><i class="fas fa-edit fa-lg edit_icon"></i></a>
                         <a href="{{ route('customer.payment-delete',$data->CustPaymId ) }}" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
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
  {{-- Employee information --}}

</div>
{{-- holeseller --}}
<script type="text/javascript">
  function holeseller(){
    // {{-- ajax call --}}
    $.ajax({
        url: "{{ route('holeseller-wise.customer') }}",
        type:"GET",
        dataType:"json",
        success:function(data) {
          if(data !=""){
            $('select[name="Customer"]').empty();
            $('select[name="Customer"]').append('<option value="">Select Customer </option>');

            $.each(data, function(key, value){
               $('select[name="Customer"]').append('<option value="'+ value.CustId +'">' + value.CustName+ '</option>');
            });
          }

        },

    });
    /* ++++++++++++++++++ */
  }

  function retailer(){
    // {{-- ajax call --}}
    $.ajax({
        url: "{{ route('retailer-wise.customer') }}",
        type:"GET",
        dataType:"json",
        success:function(data) {
          if(data !=""){
            $('select[name="Customer"]').empty();
            $('select[name="Customer"]').append('<option value="">Select Customer </option>');

            $.each(data, function(key, value){
               $('select[name="Customer"]').append('<option value="'+ value.CustId +'">' + value.CustName+ '</option>');
            });
          }

        },

    });
    /* ++++++++++++++++++ */
  }
  // {{-- Select Value --}}
  $(document).ready(function(){

    $('select[name="Customer"]').on('change', function(){
        var Customer = $(this).val();

        if(Customer) {
            $.ajax({
                url: "{{ route('customerId-wise-customerdue') }}",
                type:"POST",
                dataType:"json",
                data: { Customer:Customer },
                success:function(data) {
                  $("#CurrentDue").text(data.customerDue);
                  $('input[id="CurrentDue"]').val(data.customerDue);
                },

            });
        }
    });



  });


  // {{-- end script tags --}}
</script>

@endsection
