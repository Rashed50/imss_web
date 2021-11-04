@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>My Award Applications</h4>
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
                    <th>Manage</th>

                </tr>
              </thead>
              <tbody>
                @foreach($all as $data)
                <tr>
                    <td>{{$data->awardInfo->award_title}}</td>
                    <td>{{date('d M Y', strtotime($data->awardInfo->award_starting))}} - {{date('d M Y', strtotime($data->awardInfo->award_ending))}}</td>
                    <td>{{$data->created_at->format('d M Y | h:i:s A')}}</td>
                    <td>Ongoing</td>
                    <td>
                        <div class="btn-group">
                          <button class="btn btn-dark btn-sm" type="button">Manage</button>
                          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split waves-effect btn-label waves-light card_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-chevron-down"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a target="_blank" class="dropdown-item" href="{{url('award/edit-apply/'.$data->awardInfo->award_slug)}}">Edit</a>
                              <!-- <a class="dropdown-item" href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->award_id}}">Delete</a> -->
                          </div>
                        </div>
                    </td>
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
