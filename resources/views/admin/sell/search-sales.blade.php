@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

<style>
    .dtHorizontalWrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    #dtHorizontal th,
    td {
        white-space: nowrap;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>

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
                    <div class="col-md-5 border border-light">

                        <div style="color: black; margin-left: 40px; margin-right: 0px; font-size: 15px; display: flex; font-weight: 500;" class="row mt-2 pt-2">
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" onclick="holeseller()" id="Wholeseller" value="1">
                                    <label class="form-check-label" for="Wholeseller">Wholeseller</label>
                                </div>
                            </div>
                            <div class="col-md-6 pl-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" onclick="retailer()" id="Retailer" value="2">
                                    <label class="form-check-label" for="Retailer">Retailer</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="WholesellerCustomer" class=" form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Wholeseller:</label>
                            <div class="col-sm-7">
                                <select class="js-example-basic-single form-control" name="Customer">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div> -->

                        <!-- <div id="RetailerCustomer" class="d-none  form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Retailer:</label>
                            <div class="col-sm-7">
                                <select id="retailer-select" class="form-control" name="Customer">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div> -->


                    </div>
                    <div class="col-md-4">
                        <div class=" form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <div class="col-sm-12">
                                <select class="js-example-basic-single form-control" name="Customer">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="date" value="date('Y-m-d')">
                        </div>
                    </div>
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

                        <table id="dtHorizontal" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Name</th>
                                    <th scope="col">Trade</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Due</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody id="customerSalesInfo">

                            </tbody>
                        </table>


                    </div>

                    <div class="col-md-6 rounded border border-primary">

                        <table id="dtHorizontal2" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td>Category</td>
                                    <td>Brand</td>
                                    <td>Size</td>
                                    <td>Thicness</td>
                                    <td>Quty</td>
                                    <td>Amount</td>
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
                        $('select[name="Customer"]').append('<option value="' + value.CustId + '">' + value.TradeName + '==' + value.ContactNumber + '</option>');
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
                        $('select[name="Customer"]').append('<option value="' + value.CustId + '">' + value.CustName + '==' + value.ContactNumber + '</option>');
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
                                    <td>${value.customer.CustName}</td>
                                    <td>${value.customer.TradeName}</td>
                                    <td>${value.SellingDate}</td>
                                    <td>${value.TotalAmount}</td>
                                    <td>${value.PaidAmount}</td>
                                    <td>${value.DueAmount}</td>
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

    // Details salary record
    function viewsalesRecord(ProdSellId) {
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
                                <td>${value.category.CateName}</td>
                                <td>${value.brand.BranName}</td>
                                <td>${value.size.SizeName}</td>
                                <td>${value.thickness.ThicName}</td>
                                <td>${value.Quantity}</td>
                                <td>${value.Amount}</td>
                                </tr>
                               `
                });

                $('#salesDetails').html(rows);

            },

        });

    }


    // {{-- end script tags --}}

    $(document).ready(function() {
        $('#dtHorizontal').DataTable({
            "scrollX": true,
        });

        $('#dtHorizontal2').DataTable({
            "scrollY": 200,
        });

        $('.dataTables_length').addClass('bs-select');
    });
</script>


@endsection