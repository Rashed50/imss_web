@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
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

  <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('customer.update') : route('customer.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} customer Information</h3>
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

                    <div class="form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Customer Name" class="form-control" id="CustName" name="CustName" value="{{(@$data)?@$data->CustName:old('CustName')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('CustName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CustName') }}</strong>
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
                    <div class="form-group row custom_form_group{{ $errors->has('ContactNumber') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Contact Number:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                            <input type="hidden" name="VendId" value="{{@$data->VendId ?? ''}}">
                            <input type="text" placeholder="Contact Number" class="form-control" id="ContactNumber" name="ContactNumber" value="{{(@$data)?@$data->ContactNumber:old('ContactNumber')}}" required>
                        @if ($errors->has('ContactNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ContactNumber') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('FatherName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Father Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Father Name" class="form-control" id="FatherName" name="FatherName" value="{{(@$data)?@$data->FatherName:old('FatherName')}}" required>
                        @if ($errors->has('FatherName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('FatherName') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('NID') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">NID NO. :</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="NID NO." class="form-control" name="NID" value="{{(@$data)? @$data->NID:old('NID')}}" required autocomplete="off">
                        @if ($errors->has('NID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('NID') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('DueAmount') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Due Amount :</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Due Amount is 0.00 TK" class="form-control" id="DueAmount" name="DueAmount" value="{{(@$data)?@$data->DueAmount:old('DueAmount')}}" required>
                        @if ($errors->has('DueAmount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('DueAmount') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('InitialDue') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Initial Due Balance:</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Initial Balance is 0.00 TK" class="form-control" id="InitialDue" name="InitialDue" value="{{(@$data)?@$data->InitialDue:old('InitialDue')}}" required>
                        @if ($errors->has('InitialDue'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('InitialDue') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="form-group row custom_form_group{{ $errors->has('CustTypeId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Type :</span></label>
                        <div class="col-sm-7">
                            <select class="form-control" name="CustTypeId" id="CustTypeId">
                                <option value="">Select category</option>
                                @foreach($allType as $type)
                                <option value="{{$type->CusTypeId}}">{{$type->TypeName}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('CustTypeId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CustTypeId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('DiviId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Division Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" id="DiviId" name="DiviId">
                              <option value="">Select Division</option>
                              @foreach($Division as $div)
                              <option value="{{$div->DiviId}}" {{(@$data->DiviId==$div->DiviId)?'selected': ''}}>{{$div->DiviName}}</option>
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
                        <input type="text" placeholder="Vendor Address" class="form-control" id="Address" name="Address" value="{{(@$data)?@$data->Address:old('Address')}}" required>
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

                        <div class="pl-2">
                            <img id="showImage" height="70" alt="">
                        </div>
                    </div>
                
                </div>
              </div>
                <style>
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
                    </div>
         
        </div>

        <div class="card-footer card_footer_button text-center">
            <button type="submit" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SUBMIT' }}</button>
        </div>
    </div>
  </form>
  </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
<script language="JavaScript">


    Webcam.set({
        width: 200,
        height: 100,
        dest_width: 150,
        dest_height: 100,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });
     // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = true;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    $('#off').click(function(){
        Webcam.reset();
        $('#my_camera').removeClass('my_camera');
        $('#off').addClass('d-none');
        $('#on').removeClass('d-none');
    });

    $('#on').click(function(){
      Webcam.reset();
        Webcam.on();
        $('#my_camera').addClass('my_camera');
        $('#on').addClass('d-none');
        $('#off').removeClass('d-none');
    });


    Webcam.attach( '.my_camera' );

    
  
    function take_snapshot() {
      shutter.play();
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
@endsection
