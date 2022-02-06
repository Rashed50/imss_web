@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Starlight</a>
    <span class="breadcrumb-item active">Activity</span>
</nav>

<div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title">Product Activity Information</h3>
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
                            @if(Session::has('error_no_data'))
                            <div class="alert alert-danger alerterror" role="alert">
                                <strong>Opps!</strong> {{Session::get('error_no_data')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <!-- row start -->
                    <div class="row">
                        <!-- 1st col -->
                        <div class="col-md-4" style="border: 1px solid black">
                            <form action="{{ route('product.activity.brand') }}" method="post">
                                @csrf
                                <div class="form-group row custom_form_group{{ $errors->has('idForCategory') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Category Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($allCate as $cat)
                                            <option value="{{ $cat->CateId }}" {{ (@$data->CateId==$cat->CateId)?'selected': '' }}>{{ $cat->CateName }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('idForCategory'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForCategory') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="margin-top:30px">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                                            <table id="" class="table responsive mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Brand Name</th>
                                                                        <th>Check</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="onlyBrand">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer card_footer_button text-center">
                                    <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">UPDATE</button>
                                </div>
                            </form>
                        </div>

                        <!-- 2nd col -->
                        <div class="col-md-4" style="border: 1px solid black">
                            <form action="{{ route('product.activity.size') }}" method="post">
                                @csrf
                                <div class="form-group row custom_form_group{{ $errors->has('idForCategory') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Category Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($allCate as $cat)
                                            <option value="{{ $cat->CateId }}" {{ (@$data->CateId==$cat->CateId)?'selected': '' }}>{{ $cat->CateName }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('idForCategory'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForCategory') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row custom_form_group{{ $errors->has('idForBrand') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Brand Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForBrand" id="idForBrand">
                                            <option value="">Select Brand</option>
                                        </select>
                                        @if ($errors->has('idForBrand'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForBrand') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="margin-top:30px">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                                            <table id="" class="table responsive mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Brand </th>
                                                                        <th>Size </th>
                                                                        <th>Check</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="categoryBrand">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer card_footer_button text-center">
                                    <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">UPDATE</button>
                                </div>
                            </form>
                        </div>

                        <!-- 3hrd col -->
                        <div class="col-md-4" style="border: 1px solid black">
                            <form action="{{ route('product.activity.thik') }}" method="post">
                                @csrf
                                <div class="form-group row custom_form_group{{ $errors->has('idForCategory') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Category Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($allCate as $cat)
                                            <option value="{{ $cat->CateId }}" {{ (@$data->CateId==$cat->CateId)?'selected': '' }}>{{ $cat->CateName }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('idForCategory'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForCategory') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row custom_form_group{{ $errors->has('idForBrand') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Brand Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForBrand" id="idForBrand">
                                            <option value="">Select Brand</option>
                                        </select>
                                        @if ($errors->has('idForBrand'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForBrand') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('idForSize') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Size Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="idForSize" id="idForSize_val">
                                            <option value="">Select Size</option>
                                        </select>
                                        @if ($errors->has('idForSize'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idForSize') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="margin-top:30px">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                                            <table id="" class="table responsive mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Brand</th>
                                                                        <th>Size</th>
                                                                        <th>Thickness</th>
                                                                        <th>Check</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="categoryBrandSize">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer card_footer_button text-center">
                                    <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- row end -->
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('select[name="idForCategory"]').on('change', function() {
            var CategoryID = $(this).val();
            if (CategoryID) {
                $.ajax({
                    url: "{{ route('Category-wise-Brand') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        CategoryID: CategoryID
                    },
                    success: function(response) {

                        if (response) {
                            $('#idForBrand[name="idForBrand"]').empty();
                            $('#idForBrand[name="idForBrand"]').append('<option>Select Brand</option>');

                            $('#idForSize_val[name="idForSize"]').empty();
                            $('#idForSize_val[name="idForSize"]').append('<option>Select Size</option>');

                            var rows = "";
                            $.each(response, function(key, value) {
                                rows += `
                                        <tr>
                                            <td>${value.BranName}</td>
                                                <td id="">
                                                    <div class="row align-items-center">
                                                        <input type="hidden" id="empId${value.BranId}" value="${value.BranId}">
                                                        <input type="checkbox" id=onlyBrand"" name="brandId[]" value="${value.BranId}">
                                                    </div>
                                                </td>
                                        </tr>
                                        `

                                $('#idForBrand[name="idForBrand"]').append('<option value="' + value.BranId + '">' + value.BranName + '</option>');
                            });
                            $('#onlyBrand').html(rows);

                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            if ($.isEmptyObject(response.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: response.success
                                })
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: response.error
                                })
                            }
                            //  end message
                        }

                    },

                });
            } else {

            }
        });


        $('select[name="idForBrand"]').on('change', function() {
            var BranId = $(this).val();
            if (BranId) {
                $.ajax({
                    url: "{{ route('Brand-wise-size') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        BranId: BranId
                    },
                    success: function(response) {

                        if (response) {
                            $('#idForSize_val[name="idForSize"]').empty();
                            $('#idForSize_val[name="idForSize"]').append('<option value="">Select Size</option>');

                            var rows = "";
                            $.each(response, function(key, value) {
                                rows += `
                                            <tr>
                                               <td>${value.BranId}</td>
                                                <td>${value.SizeName}</td>
                                                    <td id="">
                                                        <div class="row align-items-center">
                                                            <input type="hidden" id="empId${value.SizeID}" value="${value.SizeID}">
                                                            <input type="checkbox" name="SizeID[]" id="categoryBrandCheck" value="${value.SizeID}">
                                                        </div>
                                                    </td>
                                            </tr>
                                         `

                                $('#idForSize_val[name="idForSize"]').append('<option value="' + value.SizeId + '">' + value.SizeName + '</option>');
                            });
                            $('#categoryBrand').html(rows);

                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            if ($.isEmptyObject(response.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: response.success
                                })
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: response.error
                                })
                            }
                            //  end message
                        }

                    },

                });
            } else {

            }
        });

        $('select[name="idForSize"]').on('change', function() {
            var Size = $(this).val();
            if (Size) {
                $.ajax({
                    url: "{{ route('size-wise-thickness') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        Size: Size
                    },
                    success: function(response) {

                        if (response) {
                            // $('#idForBrand[name="idForBrand"]').empty();
                            var rows = "";
                            $.each(response, function(key, value) {
                                rows += `
                                        <tr>
                                               <td>${value.BranId}</td>
                                                <td>${value.SizeId}</td>
                                                <td>${value.ThicName}</td>
                                                    <td id="">
                                                        <div class="row align-items-center">
                                                            <input type="hidden" id="empId${value.ThicId}" value="${value.ThicId}">
                                                            <input type="checkbox" name="ThicId[]" id="categoryBrandSize" value="${value.ThicId}">
                                                        </div>
                                                    </td>
                                            </tr>
                                        `
                                // $('#ThicId_val[name="ThicID"]').append('<option value="'+ value.ThicId+'">' + value.ThicName + '</option>');
                            });
                            $('#categoryBrandSize').html(rows);

                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            if ($.isEmptyObject(response.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: response.success
                                })
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: response.error
                                })
                            }
                            //  end message
                        }

                    },

                });
            } else {

            }
        });




        $('#categoryBrandCheck').on('change', function(){ // on change of state
            if(this.checked) // if changed state is "CHECKED"
                {
                    alert('ookk');
                }
            })

        $("#categoryBrandCheck").attr('checked', true, function(){
            alert('ookk');
        }); // Deprecated
        $(".myCheckbox").prop('checked', true , function(){
            alert('okk');
        });
        $('.myCheckbox').is(':checked');
    })
</script>
@endsection