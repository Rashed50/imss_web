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

        <div class="form-group row custom_form_group{{ $errors->has('CustTypeId') ? ' has-error' : '' }}">
            <label class="col-sm-3 control-label">Customer Type :</span></label>
            <div class="col-sm-7">
                <select class="form-control" name="CustTypeId" id="CustTypeId">
                    <option value="">Select Type</option>
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

    <div class="form-group row custom_form_group{{ $errors->has('searchCustomer') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Search by :</span></label>
        <div class="col-sm-7">
            <input class="form-control" name="searchCustomer" value="{{@$sResult}}" placeholder="Customer Name or Trade or Address or Phone Number">
            
            @if ($errors->has('searchCustomer'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('searchCustomer') }}</strong>
                </span>
            @endif
        </div>
    </div>


</div>