@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->


  <div class="sl-pagebody">

    <div class="row row-sm">
      <div class="col-sm-4 col-xl-3">
        <div class="card pd-20 bg-primary">
            <a href="" class="tx-white-8 hover-white" id="leave_application_edit_button" data-toggle="modal" data-target="#customer_list_report_modal">
                        Customers
            </a>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
        <div class="card pd-20 bg-info">


          <!-- <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Week's Sales</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div> 
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">$4,625</h3>
          </div> 
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Gross Sales</span>
              <h6 class="tx-white mg-b-0">$2,210</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Tax Return</span>
              <h6 class="tx-white mg-b-0">$320</h6>
            </div>
          </div>  -->
        </div><!-- card -->
      </div><!-- col-3 -->

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="card pd-20 bg-purple">
            
        </div><!-- card -->
      </div> 

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="card pd-20 bg-sl-primary">
           
        </div><!-- card -->
      </div><!-- col-3 -->

    </div><!-- row -->
  </div>
  <!-- sl-pagebody -->

<!-- Customer list Report Modal -->
<div class="modal fade" id="customer_list_report_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Customer Report </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="customer_report_form" target="_blank" action="{{ route('report.customer.list') }}" method="post">
        @csrf
          <div class="modal-body">
                <div class="form-group row custom_form_group">                       
                    <label class="control-label col-md-4">Type</label>
                    <div class="col-md-8">
                         <select class="form-select" name="customer_type" id="customer_type" required>                             
                            <option value="1"> Whole Sell Customer</option>  
                            <option value="2"> Retrail Customer</option>              
                        </select> 
                    </div> 
                </div>
              <div class="form-group row custom_form_group">
                    <label class="col-sm-4 control-label">Due Amount:</label>
                    <div class="col-sm-8">
                        <input type="number" placeholder="Enter Minimum Due Amount" class="form-control" id="due_amount" name="due_amount" value="0" >
                    </div>
              </div> 
                <div class="form-group row custom_form_group">
                  <label class="control-label col-md-4">Report</label>
                  <select name="report_type" class="form-control col-md-8" id="report_type">
                    <option value="1">Employee List</option>
                    <option value="2">Summary Month by Month</option>
                  </select>
                </div> 
            
          </div>
          <div class="modal-footer">
              <div class="row">
                <div class="col-sm-6 text-left">
                <button type="submit" class="btn btn-primary">Report</button>
                </div>
                <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
          </div>
        </form> 
    </div>
  </div>
</div>

@endsection
