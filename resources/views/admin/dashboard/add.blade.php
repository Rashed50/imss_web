@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="#" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">New Banner Information</h3>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                  <div class="card-body card_form">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if(Session::has('success'))
                              <div class="alert alert-success alertsuccess" role="alert" style="margin-left: -20px">
                                 <strong>Successfully!</strong> Added New Banner.
                              </div>
                            @endif
                            @if(Session::has('error'))
                              <div class="alert alert-warning alerterror" role="alert" style="margin-left: -20px">
                                 <strong>Opps!</strong> please try again.
                              </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>






                    <div class="form-group row custom_form_group{{ $errors->has('ban_title') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Title:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Banner Title" class="form-control" id="ban_title" name="ban_title" value="{{old('ban_title')}}" required>
                          @if ($errors->has('ban_title'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ban_title') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group">
                        <label class="col-sm-3 control-label">Subtitle:</label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Banner Subtitle" class="form-control" id="ban_subtitle" name="ban_subtitle" value="{{old('ban_subtitle')}}">
                        </div>
                    </div>
                    <div class="form-group row custom_form_group">
                        <label class="col-sm-3 control-label">Caption:</label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Banner Caption" class="form-control" id="ban_caption" name="ban_caption" value="{{old('ban_caption')}}">

                        </div>
                    </div>
                    <div class="form-group row custom_form_group">
                        <label class="col-sm-3 control-label">Description:</label>
                        <div class="col-sm-7">
                          <textarea name="ban_description" class="form-control" placeholder="Banner Description">{{ old('ban_description') }}</textarea>

                        </div>
                    </div>


                    <div class="form-group row custom_form_group{{ $errors->has('ban_image') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Banner Image:</label>
                        <div class="col-sm-4">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file btnu_browse">
                                      Browse… <input type="file" name="ban_image" id="imgInp3" accept="image/x-png,image/gif,image/jpeg">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                          </div>
                          @if ($errors->has('ban_image'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ban_image') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="col-md-3">
                          <img id='img-upload3' width="200"/>
                        </div>
                    </div>


                  </div>
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">SAVE</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- list -->
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>Banner List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if(Session::has('success_soft'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> delete Banner information.
                              </div>
                            @endif

                            @if(Session::has('success_update'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> update Banner information.
                              </div>
                            @endif

                            @if(Session::has('error'))
                              <div class="alert alert-warning alerterror" role="alert">
                                 <strong>Opps!</strong> please try again.
                              </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>

                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <th>Description</th>
                                            <th>Caption</th>
                                            <th>Company Name</th>
                                            <th>Entered By</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>

                                                <a href="#" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon"></i></a>

                                                <a href="#" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->





@endsection
