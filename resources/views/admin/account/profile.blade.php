@extends('layouts.admin')
@section('content')
@php

@endphp
<div class="row">
    <div class="col-xl-3">
        <div class="card overflow-hidden">
            <div class="bg-soft-primary">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">

                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{asset('contents/admin')}}/assets/images/profile-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="avatar-md profile-user-wid mb-4 float-left mar_right_10">
                          @if(Auth::user()->photo!='')
                            <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                          @else
                            <img src="{{asset('uploads/avatar/avatar-black.png')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                          @endif
                        </div>
                        <div class="pt-2 float-left user_profile_text">
                          <h5 class="font-size-15 text-truncate mb-1">{{Auth::user()->name}}</h5>
                          <p class="text-muted mb-0 text-truncate">{{Auth::user()->userInfo->role_name}}</p>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->status==1)
                <div class="card-body card_body_menu">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="profile_menu">
                        <div class="profile_heading">
                          NAVIGATION
                        </div>
                        <ul>
                            <li><a href="{{ url('dashboard/account')}}"><i class="fa fa-user"></i> Overview</a></li>
                            <li><a href="{{url('dashboard/member/information')}}"><i class="fa fa-user"></i> Update Information</a></li>
                            <li><a href="{{url('dashboard/member/password')}}"><i class="fa fa-arrows-alt"></i> Change Password</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="card-footer profile_card_footer text-center">
                    <a href="" class="btn btn-md btn-dark waves-effect btn-label waves-light card_btn" data-toggle="modal" data-target="#paymentModal"><i class="fas fa-wallet label-icon"></i>PAYMENT</a>
                </div> -->
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="row">
          <div class="col-md-12">
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
        </div>

        <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <div class="row">

                          @php
                            $totalUser=App\Models\User::where('status',1)->count();
                            $all=App\Models\Designation::where('designation_status',1)->count();
                            $totalClient=App\Models\CommitteeCategory::where('cat_status',1)->orderBy('cat_id','ASC')->count();
                            $totalBan=App\Models\Committee::where('committee_status',1)->orderBy('committee_id','DESC')->count();
                          @endphp
                          <div class="col-lg-3">
                              <div class="media">
                                <div class="mr-3 mt-1 mb-1">
                                    <div class="avatar-sm mx-auto">
                                        <div class="avatar-title bg-light rounded-circle text-dark font22">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="media-body align-self-center">
                                      <div class="text-muted">
                                          <h5 class="mb-1">{{$totalUser}}</h5>
                                          <p class="mb-0">Total Member</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="media">
                                <div class="mr-3 mt-1 mb-1">
                                    <div class="avatar-sm mx-auto">
                                        <div class="avatar-title bg-light rounded-circle text-dark font22">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="media-body align-self-center">
                                      <div class="text-muted">
                                          <h5 class="mb-1">{{$totalBan}}</h5>
                                          <p class="mb-0">Total Committee </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="media">
                                <div class="mr-3 mt-1 mb-1">
                                    <div class="avatar-sm mx-auto">
                                        <div class="avatar-title bg-light rounded-circle text-dark font22">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="media-body align-self-center">
                                      <div class="text-muted">
                                          <h5 class="mb-1">{{$totalClient}}</h5>
                                          <p class="mb-0">Categoris</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="media">
                                <div class="mr-3 mt-1 mb-1">
                                    <div class="avatar-sm mx-auto">
                                        <div class="avatar-title bg-light rounded-circle text-dark font22">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="media-body align-self-center">
                                      <div class="text-muted">
                                          <h5 class="mb-1">{{$all}}</h5>
                                          <p class="mb-0">Designation</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @yield('member')
    </div>
</div>

<!-- payment modal -->
<!-- <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" action="{{url('dashboard/member/payment/submit')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Payment Information</h5>
        </div>
        <div class="modal-body modal_card">
          <div class="form-group row mb-3 {{ $errors->has('amount') ? ' has-error' : '' }}">
              <label class="col-sm-3 col-form-label col_modal_form_label">Payment Amount<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="hidden" name="client" value=""/>
                <input type="hidden" name="code" value=""/>
                <input type="number" class="form-control modal_form_control" name="amount" value="{{old('amount')}}">
                @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
              </div>
          </div>
          <div class="form-group row mb-3 {{ $errors->has('project') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_modal_form_label">Project<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <select class="form-control modal_form_control" name="project">
                <option value="">select project</option>
              </select>
              @if ($errors->has('project'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('project') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3 {{ $errors->has('gateway') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_modal_form_label">Payment Gateway<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <select class="form-control modal_form_control" name="gateway">
                <option value="">select gateway</option>
              </select>
              @if ($errors->has('gateway'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('gateway') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3 {{ $errors->has('date') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_modal_form_label">Payment Date<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <div class="input-group">
                <input type="text" class="form-control modal_form_control" id="paymentDate" name="date" value="{{old('date')}}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
              </div>
              @if ($errors->has('date'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('date') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>
        <div class="modal-footer modal_footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">SAVE</button>
        </div>
      </div>
    </form>
  </div>
</div> -->
@endsection
