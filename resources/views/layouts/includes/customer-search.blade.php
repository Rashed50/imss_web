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

    <div class="form-group row custom_form_group" style="align-items:center">
        <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label>
        <div class="col-sm-4">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="type" value="1" id="btnradio1" autocomplete="off" checked>
            <label class="btn" for="btnradio1"> Whole Seller</label>

            <input type="radio" class="btn-check" name="type" value="2" id="btnradio2" autocomplete="off" {{ ($allCustomer[0]->CustTypeId==2)?'checked' : '' }}>
            <label class="btn" for="btnradio2">Retailer</label>
            </div>
        </div>
    </div>

    <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">District:</span></label>
        <div class="col-sm-7">

            <select class="form-control" name="DistId" id="DistId">
                <option value="">Select District</option>
                @foreach($allDistrict as $district)
                <option value="{{$district->DistId}}">{{$district->DistName}}</option>
                @endforeach
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
                <option value="">Select Thana</option>
                <option value="{{@$data->ThanId}}">{{@$data->Thana->ThanaName ??''}}</option>
            </select>
            @if ($errors->has('ThanId'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ThanId') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>