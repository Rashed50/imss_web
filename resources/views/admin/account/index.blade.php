@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>My Personal Information</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Name</p>
                  <h4 class="profile_highlight_text">{{Auth::user()->name}}</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Phone</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->phone}}
                  </h4>
              </div>
          </div>

        </div>
        <div class="col-md-6">
            <div class="media mb-3">
                <div class="media-body">
                    <p class="text-muted font-weight-medium profile_highlight_heading">Email</p>
                    <h4 class="profile_highlight_text">
                        {{Auth::user()->email}}
                    </h4>
                </div>
            </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">User Name</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->username}}
                  </h4>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer card_footer">
      .
    </div>
</div>
@endsection
