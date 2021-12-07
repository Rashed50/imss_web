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
            <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('labour.update') : route('labour.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Labour Cost Information</h3>
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

                    <div class="form-group row custom_form_group{{ $errors->has('idOfcategory') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Category Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" name="idOfcategory" id="idOfcategory">
                            <option value="">Select Category</option>
                            @foreach ($allCate as $cat)
                             <option value="{{ $cat->CateId }}" {{ ($data->CateId==$cat->CateId)? 'selected' : ''}}>{{ $cat->CateName }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('idOfcategory'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('idOfcategory') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                 
                    <div class="form-group row custom_form_group{{ $errors->has('sizeID') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Size Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <select class="form-control" name="sizeID" id="IdOfSize">
                            @if(@$data)
                            <option value="{{ @$data->SizeId }}">{{ @$data->sizeInfo->SizeName }}</option>
                            @else
                            <option value="">Select Size</option>
                            @endif
                          </select>
                          @if ($errors->has('sizeID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('sizeID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                     <div style="color: black; margin-left: 40px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;"  class="row {{ $errors->has('LaboType') ? ' has-error' : '' }} mt-2 pt-2">
                       <label class="col-sm-3 control-label">Labour Type:<span class="req_star">*</span></label> 
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="LaboType" id="Load" value="Load" {{(@$data->LaboType=='Load')? 'checked':''}}>
                            <label class="form-check-label" for="Load">Load</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="LaboType" id="Unload" value="Unload"{{(@$data->LaboType=='Unload')? 'checked':''}}>
                            <label class="form-check-label" for="Unload">Unload</label>
                          </div>
                        </div>
                        @if ($errors->has('LaboType'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('LaboType') }}</strong>
                              </span>
                          @endif
                      </div>

                        <div class="form-group row custom_form_group{{ $errors->has('Amount') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Labour Cost:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Labour Cost" class="form-control" id="Amount" name="Amount" value="{{(@$data)?@$data->Amount:old('Amount')}}" required>
                          <input type="hidden" name="LaboId" value="{{@$data->LaboId ?? ''}}">
                          @if ($errors->has('Amount'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Amount') }}</strong>
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
    <!-- list -->
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>Labour Cost List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Category</th>
                                            <th>Size</th>
                                            <th>Labour Type</th>
                                            <th>Amount</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($allLabour as $key=>$labour)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $labour->cateInfo->CateName ??'' }}</td>
                                            <td>{{ $labour->sizeInfo->SizeName ??'' }}</td>
                                            <td>{{ $labour->LaboType ??'' }}</td>
                                            <td>{{ $labour->Amount ??'' }}</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('labour.edit',$labour->LaboId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
        </div>
    </div>
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->

  <script>
    $(document).ready(function(){

        $('select[name="idOfcategory"]').on('change', function(){
            var CateId = $(this).val();
            // alert(CateId);
            
            if(CateId){
                $.ajax({
                    url: "{{ route('CategoryIdWiseSize') }}",
                    type: "POST",
                    data : { CateId:CateId },
                    dataType: "json",
                    success: function(data){
                        if (data=="") {
                         
                           $('#IdOfSize[name="sizeID"]').empty();
                           $('#IdOfSize[name="sizeID"]').append('<option value="">Data Not Found!</option>');
                        }else{
                           $('#IdOfSize[name="sizeID"]').empty();
                           $('#IdOfSize[name="sizeID"]').append('<option value="">Select Size</option>');
                           $.each(data, function(key , value){
                           $('#IdOfSize[name="sizeID"]').append('<option value="'+value.SizeId+'">'+value.SizeName+'</option>');
                            });

                        }
                        
                    },
                });
            }else{
                alert('Please select size');
            }
        });
    
    });

 </script>
@endsection
