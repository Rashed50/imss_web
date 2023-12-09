@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->


<!-- Session Message -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if(Session::has('success'))
          <div class="alert alert-success alertsuccess" role="alert">
                <strong> {{Session::get('success')}}</strong>
          </div>
        @endif
        @if(Session::has('error'))
          <div class="alert alert-warning alerterror" role="alert">
             <strong> {{Session::get('error')}}</strong>
          </div>
        @endif
    </div>
    <div class="col-md-1"></div>
</div>

<div class="sl-pagebody" style="padding:0px;">
    <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('customer.update') : route('customer.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Customer Information</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('customer.list')}}" class="btn btn-success btn-sm"  style=" border: 1px solid red; border-radius: 10px;">Customer List</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card-body card_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row custom_form_group{{ $errors->has('CustTypeId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Type :</span></label>
                        <div class="col-sm-7">
                            <select class="form-control" name="CustTypeId" id="CustTypeId" autofocus required>
                                <option value="">Select category</option>
                                @foreach($allType as $type)
                                <option value="{{$type->CusTypeId}}" {{ $type->CusTypeId == @$data->CustTypeId ? 'selected':'' }}>{{$type->TypeName}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('CustTypeId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CustTypeId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Customer Name" class="form-control" id="CustName" name="CustName" value="{{(@$data)?@$data->CustName : old('CustName')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('CustName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CustName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('CustNameBl') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Name Bengla:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Customer Name (Bengla)" class="form-control" id="CustNameBl" name="CustNameBl" value="{{(@$data)?@$data->CustNameBl : old('CustNameBl')}}">
                           @if ($errors->has('CustNameBl'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CustNameBl') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('TradeName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Trade Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Trade Name" class="form-control" id="TradeName" name="TradeName" value="{{(@$data)?@$data->TradeName:old('TradeName')}}" required>
                        @if ($errors->has('TradeName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('TradeName') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('TradeNameBl') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Trade Name (Bengla):<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Trade Name (Bengla)" class="form-control" id="TradeNameBl" name="TradeNameBl" value="{{(@$data)?@$data->TradeNameBl:old('TradeNameBl')}}">
                        @if ($errors->has('TradeNameBl'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('TradeNameBl') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('FatherName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Father Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Father Name" class="form-control" id="FatherName" name="FatherName" value="{{(@$data)?@$data->FatherName:old('FatherName')}}">
                        @if ($errors->has('FatherName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('FatherName') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('ContactNumber') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Contact No. :<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                            <input type="hidden" name="VendId" value="{{@$data->VendId ?? ''}}">
                            <input type="text" placeholder="Contact Number" class="form-control" id="ContactNumber" name="ContactNumber" value="{{(@$data)?@$data->ContactNumber:old('ContactNumber')}}" required>
                            <span id="duplicate_number" style="color: red;"></span>
                            @if ($errors->has('ContactNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ContactNumber') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('NID') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">NID No. :</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="NID NO." class="form-control" name="NID" value="{{(@$data)? @$data->NID:old('NID')}}" autocomplete="off">
                        @if ($errors->has('NID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('NID') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group">
                        <label class="col-sm-3 control-label">Initial Due:</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Initial Balance is 0.00 TK" class="form-control" id="InitialDue" name="InitialDue" value="{{(@$data)?@$data->InitialDue:0}}" required>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group row custom_form_group{{ $errors->has('DiviId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Division:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" id="DiviId" name="DiviId">
                              <option value="">Select Division</option>
                              @foreach($Division as $div)
                              <option value="{{$div->DiviId}}" {{(@$data->DiviId==$div->DiviId)?'selected': ''}} >{{$div->DiviName}}</option>
                              @endforeach
                          </select>
                          @if ($errors->has('DiviId'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('DiviId') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">District:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="DistId" id="DistId">
                                <option value="{{@$data->DistId}}">{{@$data->District->DistName ??''}}</option>
                            </select>
                            @if ($errors->has('DistId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('DistId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ThanId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Thana:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="ThanId" id="ThanId">
                                <option value="{{@$data->ThanId}}">{{@$data->Thana->ThanaName ??''}}</option>
                            </select>
                            @if ($errors->has('ThanId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ThanId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('UnioId') ? ' has-error' : '' }}">
                         <label class="col-sm-3 control-label">Union :</span></label>
                         <div class="col-sm-7">

                           <select class="form-control" name="UnioId" id="UnioId">
                             <option value="">Select Union</option>
                           </select>


                            @if ($errors->has('UnioId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('UnioId') }}</strong>
                                </span>
                            @endif
                         </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Address') ? ' has-error' : '' }}">
                         <label class="col-sm-3 control-label">Address :</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Vendor Address" class="form-control" id="Address" name="Address" value="{{(@$data)?@$data->Address:old('Address')}}">
                            @if ($errors->has('Address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
                        </div>
                     </div>
                     <div class="form-group row custom_form_group{{ $errors->has('Photo') ? ' has-error' : '' }}">
                         <label class="col-sm-3 control-label">Photo :</span></label>
                            <div class="col-sm-5">
                             <input type="file" id="image" class="form-control" id="Photo" name="Photo">
                                @if ($errors->has('Photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        <br><br>
                        <div class="pl-6">
                            <img id="showImage" height="100" width="100" alt="">
                            <img src="{{$data->Photo ?? ''}}" id="holeCustomerImage" class="d-block" alt="no image" style="width: 100px; border: 1px solid #ddd;">
                        </div>
                    </div>

                </div>
              </div>
                    {{-- <style>
                        #my_camera{
                        border: 2px solid gray;
                        }
                    </style>
                    <div class="row" id="hide">

                        <div class="col-md-3">
                            <div class="my_camera" id="my_camera"></div>
                        </div>

                        <div class="col-md-3">
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type=button value="Off" class="" id="off" >
                            <input type=button class="d-none" id="on"  value="on">
                            <input type="hidden" name="image" class="image-tag">
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div id="results">Your captured image</div>
                        </div>

                        <div class="col-md-2"></div>
                    </div> --}}

        </div>

        <div class="card-footer card_footer_button text-center">
            <button type="submit" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SUBMIT' }}</button>
        </div>
    </div>
    </form>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
<script language="JavaScript">

    //
    // Webcam.set({
    //     width: 200,
    //     height: 100,
    //     dest_width: 150,
    //     dest_height: 100,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90,
    //     force_flash: false
    // });
    //  // preload shutter audio clip
    //     var shutter = new Audio();
    //     shutter.autoplay = true;
    //     shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
    //
    // $('#off').click(function(){
    //     Webcam.reset();
    //     $('#my_camera').removeClass('my_camera');
    //     $('#off').addClass('d-none');
    //     $('#on').removeClass('d-none');
    // });
    //
    // $('#on').click(function(){
    //   Webcam.reset();
    //     Webcam.on();
    //     $('#my_camera').addClass('my_camera');
    //     $('#on').addClass('d-none');
    //     $('#off').removeClass('d-none');
    // });
    //
    //
    // Webcam.attach( '.my_camera' );



    function take_snapshot() {
      shutter.play();
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>


<script>



    $('#CustName').keyup(function(){
        const customerType = $('#CustTypeId').val(); // 2 = retail, 1 whole sell
        var tradeName = document.getElementById('TradeName');
        if(customerType == 2){
            $('input[id="TradeName"]').val($('#CustName').val());
           // tradeName.disabled = true;
        }else {
          //  tradeName.disabled = false;

        }

    });

    $('#CustNameBl').keyup(function(){
        const customerType = $('#CustTypeId').val(); // 2 = retail, 1 whole sell
        var tradeNameBl = document.getElementById('TradeNameBl');

        if(customerType == 2){
            $('input[id="TradeNameBl"]').val($('#CustNameBl').val());
          //  tradeNameBl.disabled = true;
        }else {
           // tradeNameBl.disabled = false;
        }
    });

    {{-- $("#ContactNumber").keyup(function(){
     var ContactNumber = $('#ContactNumber').val();
     if(ContactNumber != ''){

        $.ajax({
            type: 'POST',
            url: "{{ url('dashboard/check/Contact/number') }}",
            data: {
                ContactNumber:ContactNumber
            },
            success: function(data){

                if(data.customer != null){
                    $('#duplicate_number').text('This Number Already Exist').style.color = "red";
                 }else{
                    $('#duplicate_number').text('');
                }

            }
        });

     }

    }); --}}


</script>
@endsection
