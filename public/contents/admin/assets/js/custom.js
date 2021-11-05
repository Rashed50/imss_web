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
