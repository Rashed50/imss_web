  $(document).ready(function(){
        $('#CateId_val[name="CateId"]').on('change', function(){
            var CateId = $(this).val();
            if(CateId){
                $.ajax({
                    url: "{{url('dashboard/stock/getBrand')}}/"+CateId,
                    type: "GET",
                    dataType: "Json",
                    success: function(data){
                        var d = $('#BranId_val[name="BranId"]').empty();
                        $.each(data, function(key , value){
                            $('select[name="BranId"]').append('<option value="'+value.BranId+'">'+value.BranName+'</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });
});

$(document).ready(function(){
    $( function() {
        $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        });
    } );
});


$(document).ready(function () {
    $('#image').change(function (e) {
     var reader = new FileReader();
       reader.onload = function (e) {
          $('#showImage').attr('src',e.target.result);
        }
     reader.readAsDataURL(e.target.files['0']);
    });
   });

