@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('brand-submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Add category Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('brand')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell--span-12">
                            <div class="mdc-card">
                                <h6 class="card-title">Brand Form</h6>
                                <div class="template-demo">
                                    <div class="mdc-layout-grid__inner">
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                                                <i class="material-icons mdc-text-field__icon">favorite</i>
                                                <input class="mdc-text-field__input {{ $errors->has('name') ? ' has-error' : '' }}" id="text-field-hero-input">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="text-field-hero-input" class="mdc-floating-label">Brand Name</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                                                <i class="material-icons mdc-text-field__icon">favorite</i>
                                                <input type="file"  id="image" class="mdc-text-field__input" id="text-field-hero-input">
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="text-field-hero-input" class="mdc-floating-label">Image</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                    <div class="pl-2">
                                                        <img id="showImage" height="70" src="{{asset('content/admin')}}/assets/images/faces/face1.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">SAVE</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
