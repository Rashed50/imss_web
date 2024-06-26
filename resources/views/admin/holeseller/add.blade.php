@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <div class="sl-pagebody">
    <div class="card">
        <div class="card-body card_form">
            {{-- Topbar --}}
            <form action="{{ route('product.seller') }}" target="_blank" method="post">
              @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="holeseller__topber">
                  <div class="row">
                      {{-- First --}}
                      <div class="col-md-5">
                        {{-- form input element --}}
                        <div class="form-group row custom_form_group{{ $errors->has('TradeName') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Trade Name:<span class="req_star">*</span></label>
                            <div class="col-sm-6">
                              <select class="form-control js-example-basic-single" name="TradeName">
                                <option value="">Select Trade Name</option>
                                @foreach ($allCustomer as $Customer)
                                  <option value="{{ $Customer->CustId }}">{{ $Customer->TradeName }}</option>
                                @endforeach
                              </select>
                              @if ($errors->has('TradeName'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('TradeName') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row custom_form_group{{ $errors->has('ContactNo') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Contact No:<span class="req_star">*</span></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="ContactNo" value="{{ old('ContactNo') }}" placeholder="Contact No">
                              @if ($errors->has('ContactNo'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ContactNo') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Vouchar No:<span class="req_star">*</span></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="VoucharNo" value="{{ $vouchar }}" placeholder="Vouchar No">
                              @if ($errors->has('VoucharNo'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('VoucharNo') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        {{-- form input element --}}
                      </div>
                      {{-- Second --}}
                      <div class="col-md-5">
                        {{-- form input element --}}
                        <div class="form-group row custom_form_group{{ $errors->has('SellDate') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Sell Date:<span class="req_star">*</span></label>
                            <div class="col-sm-6">
                              <input type="date" class="form-control" id="" name="SellDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                              @if ($errors->has('SellDate'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('SellDate') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row custom_form_group{{ $errors->has('DebitAccount') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Debit Account:<span class="req_star">*</span></label>
                            <div class="col-sm-6">

                              <select class="form-control" name="DebitAccount">
                                <option value="">Select Debit Account</option>
                                
                                @foreach ($chartOffAccountList as $chOfAcc)
                                 <option value="{{ $chOfAcc->ChartOfAcctId }}">{{ $chOfAcc->ChartOfAcctName }}</option>
                                @endforeach
                              </select>
                              @if ($errors->has('DebitAccount'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('DebitAccount') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        {{-- form input element --}}
                      </div>
                      {{-- Third --}}
                      <div class="col-md-2">
                        <img src="" id="holeCustomerImageShow" class="d-none" alt="no image" style="width: 100px; border: 1px solid #ddd;">
                        <img src="{{asset('uploads/no.png') }}" id="holeCustomerImage" class="d-block" alt="no image" style="width: 100px; border: 1px solid #ddd;">
                      </div>

                  </div>
                </div>
              </div>
            </div>
            {{-- Topbar --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row custom_form_group{{ $errors->has('CategoryID') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Category:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="CategoryID">
                            <option value="">Select Category</option>
                            @foreach ($allCatg as $data)
                              <option value="{{ $data->CateId }}">{{ $data->CateName }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('CategoryID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CategoryID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('BranID') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Brand:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="BranID" id="BranId_val">
                            <option value="">Select Brand</option>
                          </select>
                          @if ($errors->has('BranID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('BranID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('SizeID') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Size:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="SizeID" id="SizeId_val">
                            <option value="">Select Size</option>
                          </select>
                          @if ($errors->has('SizeID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('SizeID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('ThicID') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Thickness:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="ThicID" id="ThicId_val">
                            <option value="">Select Thickness</option>
                          </select>
                          @if ($errors->has('ThicID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ThicID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('LabourPerUnit') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Labour Cost:<span class="req_star">*</span></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="LabourPerUnit" name="LabourPerUnit" value="{{ old('LabourPerUnit') }}" placeholder="Per Unit">
                          @if ($errors->has('LabourPerUnit'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('LabourPerUnit') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('UnitPrice') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Unit Price:<span class="req_star">*</span></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="UnitPrice" value="{{ old('UnitPrice') }}" placeholder="Unit Price">
                          @if ($errors->has('UnitPrice'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('UnitPrice') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Qunatity') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Qunatity:<span class="req_star">*</span></label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" name="Qunatity" value="0">
                          @if ($errors->has('Qunatity'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Qunatity') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="col-md-4">
                          <p style="margin-top:10px; display:inline" class="btn btn-primary waves-effect" onclick="wholeSelleraddToCart()">Add To Cart</p>
                        </div>
                    </div>
                </div>

                {{-- Second Part --}}

                <div class="col-md-8">
                    <div class="SecondPart">


                        <div class="row">
                            {{-- First Item --}}
                            <div class="col-md-6">
                                <div class="form-group row custom_form_group{{ $errors->has('NetAmount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Net Amount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="NetAmount" name="NetAmount" value="{{ old('NetAmount') }}" required>
                                        @if ($errors->has('NetAmount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('NetAmount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('LabourCost') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Labour Cost:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="LabourCost" name="LabourCost" onkeyup="addedLabourCost()" value="{{ old('LabourCost') }}" required>
                                        @if ($errors->has('LabourCost'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('LabourCost') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('CarryingBill') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Carrying Bill:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="CarryingBill" name="CarryingBill" onkeyup="CarryingBillCost()" value="{{ old('CarryingBill') }}" required>
                                        @if ($errors->has('CarryingBill'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('CarryingBill') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- hidden field --}}
                                <input type="hidden" id="temporaryField" value="">
                                <input type="hidden" id="temporaryField2" value="">
                                <input type="hidden" id="temporaryField3" value="">

                                {{-- hidden field --}}
                                <div class="form-group row custom_form_group{{ $errors->has('TotalCost') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Total Cost:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="TotalCost" name="TotalCost" value="{{ old('TotalCost') }}" required>
                                        @if ($errors->has('TotalCost'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('TotalCost') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('PayAmount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Pay Amount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="PayAmount2" name="PayAmount" value="{{ old('PayAmount') }}" required onkeyup="paymentAmount()">
                                        @if ($errors->has('PayAmount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('PayAmount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Discount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="discountpersent" name="Discount" value="{{ old('Discount') }}" onkeyup="DiscountAmount()" required>
                                        @if ($errors->has('Discount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Discount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('DueAmount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Due Amount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="DueAmount" name="DueAmount" value="{{ old('DueAmount') }}" >
                                        @if ($errors->has('DueAmount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('DueAmount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>




                            </div>
                            {{-- Second Item --}}
                            <div class="col-md-6">
                              {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Set Pay Date
                                </label>
                              </div> --}}

                              <div class="form-group row custom_form_group">
                                  <label class="col-sm-3 control-label">Date:<span class="req_star">*</span></label>
                                  <div class="col-sm-6">
                                      <input type="date" class="form-control" id="" name="SellingDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                  </div>
                              </div>

                              <div class="form-group row custom_form_group">
                                  <label class="col-sm-3 control-label">Pre Due:</label>
                                  <div class="col-sm-6">
                                      <input type="text" class="form-control"  id="predueAmount" value="" disabled>
                                  </div>
                              </div>


                            </div>
                        </div>
                        {{-- Button Row --}}
                        <div class="row">
                          <div class="col-md-12">
                            <div style="margin: 10px; text-align:center; background: #f5f5f5; padding: 10px 0px;">
                              <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            {{-- Order Wise Product List --}}
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Order List</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered responsive mb-0">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Size</th>
                                                <th>Thickness</th>
                                                <th>Rate & Qunatity</th>
                                                <th>Amount</th>
                                                <th>Labour Cost</th>
                                                <th>Qunatity</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody id="holeSellerOrderList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- Order List --}}
        </div>
    </div>
  </div>
  {{-- script --}}

  <script type="text/javascript">
    $(document).ready(function(){
        $('select[name="SizeID"]').on('change', function(){
            var SizeId=$(this).val();
            var CateId=$('select[name="CategoryID"]').val();

            // alert(SizeId+'-'+CateId);

            $.ajax({
                url: "{{ route('Category.sizeWise.LabourCost')}}",
                type: "POST",
                dataType: "json",
                data: {SizeId:SizeId, CateId:CateId},
                success: function(data){
                    if (data=='') {
                        $('#LabourPerUnit').empty();
                        $('#LabourPerUnit').val(0);
                    }else{
                         $('#LabourPerUnit').empty();
                        $('#LabourPerUnit').val(data.Amount);
                    }
                }
            })
        });

    })

</script>


  <script type="text/javascript">
    // Attend Labour Cost
    function addedLabourCost(){
      var LabourCost = parseFloat( $('#LabourCost').val() );
      var NetAmount = parseFloat( $('#NetAmount').val() );

      if(LabourCost >= 0){
          var total_amount = (LabourCost + NetAmount);
          $("#TotalCost").val('');
          $("#TotalCost").val(total_amount);
          // temporaryField
          $("#temporaryField").val('');
          $("#temporaryField").val(total_amount);
      }else{
          $("#TotalCost").val('');
          $("#TotalCost").val(NetAmount);
      }
    }
    // Carrying Bill
    function CarryingBillCost(){
      var TotalCost = parseFloat( $('#TotalCost').val() );
      var CarryingBill = parseFloat( $('#CarryingBill').val() );
      var temporaryField = parseFloat( $('#temporaryField').val() );



      if(CarryingBill >= 0){
          var total_amount = (temporaryField + CarryingBill);
          $("#TotalCost").val('');
          $("#TotalCost").val(total_amount);
          $("#temporaryField2").val('');
          $("#temporaryField2").val(total_amount);
      }else{
          $("#TotalCost").val('');
          $("#TotalCost").val(temporaryField);
          $("#temporaryField2").val('');
          $("#temporaryField2").val(PayAmount);
      }
    }

    // Carrying Bill
    function DiscountAmount(){
      var temporaryField3 = parseFloat( $('#temporaryField3').val() );
      var Discount = parseFloat( $('#discountpersent').val() );

      if(Discount >= 0){
          var total_amount = (temporaryField3 - Discount);
          $("#DueAmount").val('');
          $("#DueAmount").val(total_amount);
      }else{
          $("#DueAmount").val('');
          $("#DueAmount").val(temporaryField3);
      }
    }

    function paymentAmount(){
      var temporaryField2 = parseFloat( $('#temporaryField2').val() );
      var PayAmount2 = parseFloat($("#PayAmount2").val());

      if(PayAmount2 >= 0){
          var total_amount = (temporaryField2 - PayAmount2);
          $("#DueAmount").val('');
          $("#DueAmount").val(total_amount);
          $("#temporaryField3").val(total_amount);
      }else{
          $("#DueAmount").val('');
          $("#DueAmount").val(temporaryField2);
          $("#temporaryField3").val(temporaryField2);
      }

    }


  </script>
@endsection
