@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Starlight</a>
    <span class="breadcrumb-item active">Labour Cost</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('due.payment.update') : route('due.payment.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title"> Due Payment Information</h3>
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

                    <div style="color: black; margin-left: 20px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;"  class="row {{ $errors->has('CustomerType') ? ' has-error' : '' }} mt-2 pt-2">
                       <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label> 
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CustomerType" id="Wholeseler" value="Wholeseler" onclick="holeseller()" {{(@$data->CustomerType=='Wholeseler')? 'checked':''}}>
                            <label class="form-check-label" for="Wholeseler">Wholeseler</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CustomerType" id="Retailer" value="Retailer" onclick="retailer()" {{(@$data->CustomerType=='Retailer')? 'checked':''}}>
                            <label class="form-check-label" for="Retailer">Retailer</label>
                          </div>
                        </div>
                        @if ($errors->has('CustomerType'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CustomerType') }}</strong>
                              </span>
                          @endif
                      </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Customer') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" name="Customer" id="Customer">
                            <option value="">Select Customer</option>
                            
                          </select>
                          @if ($errors->has('Customer'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Customer') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                        <div class="form-group row custom_form_group{{ $errors->has('Amount') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Amount:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" placeholder="Amount" class="form-control" id="Amount" name="Amount" value="{{(@$data)?@$data->Amount:old('Amount')}}" required>
                              @if ($errors->has('Amount'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('Amount') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Discount:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" placeholder="Discount" class="form-control" id="Discount" name="Discount" value="{{(@$data)?@$data->Discount:old('Discount')}}" required>
                              @if ($errors->has('Discount'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('Discount') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('collected') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Collected by:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <select class="form-control" name="">
                                <option value=""> Selecte Name</option>
                              @foreach ($employee as $emp)
                                <option value="{{ $emp->EmplInfoId }}">{{ $emp->Name }}</option>
                              @endforeach
                              </select>
                              @if ($errors->has('collected'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('collected') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('collectedDate') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Date:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="datepicker" name="collectedDate" value="{{(@$data)? date('d-F-Y',strtotime(@$data->collectedDatedate)):date('d-F-Y',strtotime(Carbon\Carbon::now())) }}" required autocomplete="off">
                            @if ($errors->has('collectedDate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('collectedDate') }}</strong>
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
