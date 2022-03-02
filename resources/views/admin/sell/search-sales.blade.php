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
                            <label class="col-sm-3 control-label">Cust Type:<span class="req_star">*</span></label>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" id="Wholeseller" value="1" checked {{(@$data->CreditType=='1')? 'checked':''}}>
                                    <label class="form-check-label" for="Wholeseller">Wholeseller</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CreditType" id="Retailer" value="2" {{(@$data->CreditType=='2')? 'checked':''}}>
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
                            <label class="col-sm-3 control-label">Wholeseller:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <select class="js-example-basic-single form-control" name="state">
                                    <option value="AL">Alabama</option>
                                    ...
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>

                        <div id="RetailerCustomer" class="d-none  form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Retailer:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <select id="retailer-select" class="form-control" name="state">
                                    <option value="AL">Alabama</option>
                                    ...
                                    <option value="WY">Wyoming</option>
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

                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>

                    <div class="col-md-6 rounded border border-primary">

                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
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

@endsection