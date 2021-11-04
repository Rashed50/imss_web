@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>My Award Winning Information</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
              <thead class="thead-dark">
                <tr>
                    <th>Award Name</th>
                    <th>Award Deadline</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($winner as $data)
                <tr>
                    <td>{{$data->awardInfo->award_title}}</td>
                    <td>{{date('d M Y', strtotime($data->awardInfo->award_starting))}} - {{date('d M Y', strtotime($data->awardInfo->award_ending))}}</td>
                    <td>{{$data->created_at->format('d M Y | h:i:s A')}}</td>
                    <td>Winning</td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card-footer card_footer">
      <div class="btn-group mt-2" role="group">
          <a href="#" class="btn btn-secondary">Print</a>
          <a href="#" class="btn btn-dark">PDF</a>
          <a href="#" class="btn btn-secondary">Excel</a>
      </div>
    </div>
</div>
@endsection
