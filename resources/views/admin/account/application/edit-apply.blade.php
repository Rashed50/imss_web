@extends('layouts.website')
@section('content')

<section class="py-5 apply_form_award">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="apply_form_award_title text-center">
                    <h3>Update for apply : {{$allAns[0]->awardInfo->award_title ?? ''}}</h3>
                </div>
            </div>

            
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2">
                <div class="apply_form_award_form">
                   <form class="row g-3" action="{{url('apply/award/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach($allAns as $key=> $que)
                      <div class="col-12">
                        <label for="inputAddress" class="form-label">{{$que->queInfo->question ?? ''}}?</label>
                        <textarea  class="form-control" id="inputAddress" name="ans[]" placeholder="Please your Ans?" required>{{$que->answer}}</textarea>
                        <input type="hidden" name="que[]" value="{{$que->question_id}}">
                        <input type="hidden" name="award" value="{{$que->award_id}}"/>
                        <input type="hidden" name="applyAwardId" value="{{$que->apply_award_id}}"/>
                      </div>
                    @endforeach
                    <input type="hidden" name="aSlug" value="{{$allAns[0]->awardInfo->award_slug ?? ''}}"/>

                   <div class="mb-3 col-12 d-none" id="fileAdd_show">
                    <input type="file" name="awardFile" class="form-control_zip" aria-label="file example">
                     <div id="fileAlert" class="text-danger"></div>
                  </div>

                  <div class="mb-3 col-12 text-center">
                    <label class="form-label btn btn-success btn-md activeClass">Have a File</label>
                  </div>
                  <div class="mb-3 col-12 text-center d-none" id="deActiveClass">
                    <label class="form-label btn btn-primary btn-md ">Have a No File</label>
                  </div>
                
                  <div class="col-12 text-center">
                   <button type="submit" class="btn btn-apply">Update</button>
                  </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</section>



  <script type="text/javascript">
      $(document).on('click', '.activeClass', function(){
        $('#fileAdd_show').removeClass('d-none');
        $('#deActiveClass').removeClass('d-none');
        $('#fileAdd_show input').attr('required','true');
        $('.activeClass').addClass('d-none');
      });

      $(document).on('click', '#deActiveClass', function(){
        $('#fileAdd_show').addClass('d-none');
        $('#deActiveClass').addClass('d-none');
        $('.activeClass').removeClass('d-none');
        $('#fileAdd_show input').removeAttr('required');
      });
</script>

<script type="text/javascript">
  $("input[type='file']").on("change", function () {
     if(this.files[0].size > 5020000) {
        $('#fileAlert').text("Please upload file less than 5MB. Thanks!!");
       $(this).val('');
     }else{
        $('#fileAlert').text(" ");
     }
    });
</script>

@endsection
