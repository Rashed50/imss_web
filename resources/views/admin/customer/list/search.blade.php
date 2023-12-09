@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <div class="sl-pagebody" style="padding:0px;">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('customer.list.search.result') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">Search Customer Information</h3>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                   @include('layouts.includes.customer-text')
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">SEARCH</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

  </div>
  <!-- sl-pagebody -->
@endsection
