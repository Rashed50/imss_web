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
                    <div class="col-md-2"></div>
                    <div class="col-md-8 border border-light">

                        <div style="color: black; margin-left: 40px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;" class="row {{ $errors->has('CreditType') ? ' has-error' : '' }} mt-2 pt-2">
                            <label class="col-sm-3 control-label">Cust Type:</label>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" onclick="holeseller()" id="Wholeseller" value="1" checked {{(@$data->CreditType=='1')? 'checked':''}}>
                                    <label class="form-check-label" for="Wholeseller">Wholeseller</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" onclick="retailer()" id="Retailer" value="2" {{(@$data->CreditType=='2')? 'checked':''}}>
                                    <label class="form-check-label" for="Retailer">Retailer</label>
                                </div>
                            </div>
                            @if ($errors->has('CreditType'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('CreditType') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div id="WholesellerCustomer" class=" form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Wholeseller:</label>
                            <div class="col-sm-7">
                                <select class="js-example-basic-single form-control" name="Customer">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div>

                        <div id="RetailerCustomer" class="d-none  form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Retailer:</label>
                            <div class="col-sm-7">
                                <select id="retailer-select" class="form-control" name="Customer">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"> Customer Sales Information</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customer.list')}}" class="btn btn-success btn-sm" style=" border: 1px solid red; border-radius: 10px;">Customer List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
                <div class="row">
                    <div class="col-md-6 rounded border border-primary">

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Name</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Due</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Voucher</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody id="customerSalesInfo">

                            </tbody>
                        </table>


                    </div>

                    <div class="col-md-6 rounded border border-primary">

                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                   
                                    <td>Quty</td>
                                    <td>Amount</td>
                                    <td>LabourCost</td>
                                    <td>CateId</td>
                                    <td>BranId</td>
                                    <td>SizeId</td>
                                    <td>ThicId</td>
                                </tr>
                            </thead>
                            <tbody id="salesDetails">
                                
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

        </div>
    </form>
</div>




<script>
    $(document).on('click', '#Retailer', function() {
        $('#RetailerCustomer').removeClass('d-none');
        $('#WholesellerCustomer').addClass('d-none');
    });

    $(document).on('click', '#Wholeseller', function() {
        $('#RetailerCustomer').addClass('d-none');
        $('#WholesellerCustomer').removeClass('d-none');

    });
</script>


{{-- holeseller --}}
<script type="text/javascript">
    function holeseller() {

        // {{-- ajax call --}}
        $.ajax({
            url: "{{ route('holeseller-wise.customer') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data != "") {
                    $('select[name="Customer"]').empty();
                    $('select[name="Customer"]').append('<option value="">Select Customer </option>');

                    $.each(data, function(key, value) {
                        $('select[name="Customer"]').append('<option value="' + value.CustId + '">' + value.CustName + '</option>');
                    });
                }

            },

        });
        /* ++++++++++++++++++ */
    }

    function retailer() {
        // {{-- ajax call --}}
        $.ajax({
            url: "{{ route('retailer-wise.customer') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data != "") {
                    $('select[name="Customer"]').empty();
                    $('select[name="Customer"]').append('<option value="">Select Customer </option>');

                    $.each(data, function(key, value) {
                        $('select[name="Customer"]').append('<option value="' + value.CustId + '">' + value.CustName + '</option>');
                    });
                }

            },

        });
        /* ++++++++++++++++++ */
    }
    // {{-- Select Value --}}
    $(document).ready(function() {
        

        $('select[name="Customer"]').on('change', function() {
            var Customer = $(this).val();

            if (Customer) {
                $.ajax({
                    url: "{{ route('customerId-wise-customerdue') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        Customer: Customer
                    },
                    success: function(data) {
                        $("#CurrentDue").text(data.customerDue);


                        var rows = "";
                        $.each(data.salesReport, function(key, value) {
                            rows += `
                                <tr>
                                    <td>${value.CustId}</td>
                                    <td>${value.TotalAmount}</td>
                                    <td>${value.DueAmount}</td>
                                    <td>${value.PaidAmount}</td>
                                    <td>${value.SellingDate}</td>
                                    <td>${value.VoucharNo}</td>
                                    <td>
                                      <a title="Add" onclick="viewsalesRecord(${value.ProdSellId})"><i class="fas fa-thumbs-up fa-lg edit_icon"></i></a>
                                    </td>
                                </tr>
                               `
                        });

                        $('#customerSalesInfo').html(rows);

                    },

                });
            }
        });

    });




 

    function viewsalesRecord(ProdSellId){
        // alert(id);

        $.ajax({
                    url: "{{ route('Product-SellId-wise-sale-record') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        ProdSellId: ProdSellId
                    },
                    success: function(data) {
                        var rows = "";
                        $.each(data.salesRecord, function(key, value) {
                            rows += `
                                <tr>
                                    <td>${value.Quantity}</td>
                                    <td>${value.Amount}</td>
                                    <td>${value.LabourCost}</td>
                                    <td>${value.CateId}</td>
                                    <td>${value.BranId}</td>
                                    <td>${value.SizeId}</td>
                                    <td>${value.ThicId}</td>
                                </tr>
                               `
                        });

                        $('#salesDetails').html(rows);

                    },

                });

    }


    // {{-- end script tags --}}
</script>


@endsection