<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <!-- vendor css -->
    <link href="{{ asset('contents/admin') }}/assets/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('contents/admin') }}/assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/toast/toast.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/sweetalert/sweetalert2.css" rel="stylesheet">


    <!-- dataTables css -->
    <link href="{{ asset('contents/admin') }}/assets/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/starlight.css">
    <link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/style.css">
    <script src="{{ asset('contents/admin') }}/assets/lib/jquery/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
  <body>
    <!-- left panel Include -->
    @include('layouts.includes.left_panel')
    <!-- head panel Include -->
    @include('layouts.includes.head_panel')
    <!-- right panel Include -->
    @include('layouts.includes.right_panel')
    <!-- main file -->
    <div class="sl-mainpanel">
      @yield('content')
    </div>
    <!-- footer part -->
    <footer class="sl-footer-custom">
      <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; Md Rashedul Hoque</div>
      </div>
    </footer>
    <!-- script file -->

    <script src="{{ asset('contents/admin') }}/assets/lib/popper/popper.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/bootstrap/bootstrap.js"></script>

    <script src="{{ asset('contents/admin') }}/assets/lib/jquery-ui/jquery-ui.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <!-- add -->
    <script src="{{ asset('contents/admin') }}/assets/lib/highlightjs/highlight.pack.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/select2/js/select2.min.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/datatable_active.js"></script>

    <script src="{{ asset('contents/admin') }}/assets/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/d3/d3.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/rickshaw/rickshaw.min.js"></script>
    <!-- <script src="{{ asset('contents/admin') }}/assets/lib/chart.js/Chart.js"></script> -->
    <!-- <script src="{{ asset('contents/admin') }}/assets/lib/Flot/jquery.flot.js"></script> -->
    <!-- <script src="{{ asset('contents/admin') }}/assets/lib/Flot/jquery.flot.pie.js"></script> -->

    {{-- <script src="{{ asset('contents/admin') }}/assets/lib/Flot/jquery.flot.resize.js"></script> --}}
    {{-- <script src="{{ asset('contents/admin') }}/assets/lib/flot-spline/jquery.flot.spline.js"></script> --}}
    
    {{-- <script src="{{ asset('contents/admin') }}/assets/lib/toast/toast.min.js"></script> --}}
    {{-- <script src="{{ asset('contents/admin') }}/assets/lib/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/sweetalert/code.js"></script> --}}

    <script src="{{ asset('contents/admin') }}/assets/lib/sweetalert/sweetalert2.min.js"></script>



    <script src="{{ asset('contents/admin') }}/assets/js/starlight.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/ResizeSensor.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/custom.js"></script>



    {{-- <script>
      if(Session.hasSession('message'))
        var type ="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info(" {{Session::get('message')}} ");
                break;

            case 'success':
                toastr.success(" {{Session::get('message')}} ");
                break;

            case 'warning':
                toastr.warning(" {{Session::get('message')}} ");
                break;

            case 'error':
                toastr.error(" {{Session::get('message')}} ");
                break;
        }
    endif
    </script> --}}





    <script type="text/javascript">
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

        // Category Wise Brand
        $(document).ready(function() {
          $('select[name="CategoryID"]').on('change', function(){
              var CategoryID = $(this).val();
              if(CategoryID) {
                  $.ajax({
                      url: "{{ route('Category-wise-Brand') }}",
                      type:"POST",
                      dataType:"json",
                      data: { CategoryID:CategoryID },
                      success:function(data) {
                         if(data == ""){
                           $('#BranId_val[name="BranID"]').empty();
                           $('#BranId_val[name="BranID"]').append('<option value="">Data Not Found! </option>');
                           $('#SizeId_val[name="SizeID"]').empty();
                           $('#SizeId_val[name="SizeID"]').append('<option value="">Data Not Found!</option>');
                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Data Not Found!</option>');

                         }else{
                           $('#BranId_val[name="BranID"]').empty();
                           $('#BranId_val[name="BranID"]').append('<option value="">Select Brand</option>');
                           $('#SizeId_val[name="SizeID"]').empty();
                           $('#SizeId_val[name="SizeID"]').append('<option value="">Select Size</option>');
                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Select Thickness</option>');


                           $.each(data, function(key, value){
                              $('#BranId_val[name="BranID"]').append('<option value="'+ value.BranId+'">' + value.BranName + '</option>');
                           });
                         }

                      },

                  });
              } else{

              }
          });
          // Brand Wise productSize
          $('select[name="BranID"]').on('change', function(){
              var BranId = $(this).val();
              if(BranId) {
                  $.ajax({
                      url: "{{ route('Brand-wise-size') }}",
                      type:"POST",
                      dataType:"json",
                      data: { BranId:BranId },
                      success:function(data) {
                         if(data == ""){

                           $('#SizeId_val[name="SizeID"]').empty();
                           $('#SizeId_val[name="SizeID"]').append('<option value="">Data Not Found!</option>');
                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Data Not Found!</option>');

                         }else{

                           $('#SizeId_val[name="SizeID"]').empty();
                           $('#SizeId_val[name="SizeID"]').append('<option value="">Select Size</option>');
                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Select Thickness</option>');

                           $.each(data, function(key, value){
                              $('#SizeId_val[name="SizeID"]').append('<option value="'+ value.SizeId+'">' + value.SizeName + '</option>');
                           });
                         }

                      },
                  });
              } else{

              }
          });
          // product Size Wise Thickness
          $('select[name="SizeID"]').on('change', function(){
              var Size = $(this).val();
              if(Size) {
                  $.ajax({
                      url: "{{ route('size-wise-thickness') }}",
                      type:"POST",
                      dataType:"json",
                      data: { Size:Size },
                      success:function(data) {
                         if(data == ""){

                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Data Not Found!</option>');

                         }else{

                           $('#ThicId_val[name="ThicID"]').empty();
                           $('#ThicId_val[name="ThicID"]').append('<option value="">Select Thickness</option>');

                           $.each(data, function(key, value){
                              $('#ThicId_val[name="ThicID"]').append('<option value="'+ value.ThicId+'">' + value.ThicName + '</option>');
                           });
                         }

                      },
                  });
              } else{

              }
          });




          // Trade Name Wise Customer information
          $('select[name="TradeName"]').on('change', function(){
              var TradeName = $(this).val();
              // alert(TradeName);
              if(TradeName) {
                  $.ajax({
                      url: "{{ route('TradeName-wise-Customer.information') }}",
                      type:"POST",
                      dataType:"json",
                      data: { TradeName:TradeName },
                      success:function(data) {
                         /* +++++++++++++++++++++++++++++++++++ */
                         $('input[name="ContactNo"]').val(data.ContactNumber);
                         $('input[name="CustName"]').val(data.CustName);
                         $('input[name="TradeName"]').val(data.TradeName);
                         $('input[id="predueAmount"]').val(data.DueAmount);
                         $('textarea[name="Address"]').val(data.Address);

                         if(data.Photo != ''){
                            // var noimage = {{asset('')}}
                            $('#holeCustomerImageShow').addClass("d-block");
                            $('#holeCustomerImageShow').removeAttr("d-none");
                            $('#holeCustomerImageShow').attr("src",'uploads/customer/'+data.Photo);
                            $('#holeCustomerImage').addClass("d-none");
                         }else{
                          $('#holeCustomerImage').addClass("d-block");
                          $('#holeCustomerImageShow').addClass("d-none");
                          $('#holeCustomerImage').removeAttr("d-none");
                         }
                         /* +++++++++++++++++++++++++++++++++++ */
                      },

                  });
              } else{

              }
          });
      });
      /* ================= Add To Cart  ================= */
      function addToCart(){
        /* ====== Catch Value ====== */
        var CategoryId = $('select[name="CategoryID"]').val();
        var BranId = $('select[name="BranID"]').val();
        var Size = $('select[name="SizeID"]').val();
        var Thickness = $('select[name="ThicID"]').val();
 
        var CategoryName = $('select[name="CategoryID"] option:selected').text();
        var BrandName = $('select[name="BranID"] option:selected').text();
        var SizeName = $('select[name="SizeID"] option:selected').text();
        var ThicknessName = $('select[name="ThicID"] option:selected').text();



        var UnitPrice = $('input[name="UnitPrice"]').val();
        var Qunatity = $('input[name="Qunatity"]').val();
        /* ====== Ajax Call ====== */
        $.ajax({
            url: "{{ route('product-purchase.addToCart') }}",
            type:"POST",
            dataType:"json",
            data: {
              CategoryId:CategoryId,
              BranId:BranId,
              Size:Size,
              Thickness:Thickness,
              UnitPrice:UnitPrice,
              Qunatity:Qunatity,
              // Name
              CategoryName:CategoryName,
              BrandName:BrandName,
              SizeName:SizeName,
              ThicknessName:ThicknessName,
            },
            success:function(data) {
              getOrderListInAddToCart();
              // Clear
              $('#CategoryId').val('');
              $('#BranId').val('');
              $('#Size').val('');
              $('#Thickness').val('');
              $('#UnitPrice').val('');
              $('#Qunatity').val('');
              //  start message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              })
              if($.isEmptyObject(data.error)){
                  Toast.fire({
                    type: 'success',
                    title: data.success
                  })
              }else{
                Toast.fire({
                  type: 'error',
                  title: data.error
                })
              }
              //  end message
            },
        });

        /* _________ */
      }
      /* ================= Add To Cart Order List ================= */
      function getOrderListInAddToCart(){
        /* ====== Ajax Call ====== */
        $.ajax({
            url: "{{ route('product-purchase-listIn.addToCart') }}",
            type:"GET",
            dataType:"json",
            success:function(response) {
              $('input[id="NetAmount"]').val(response.cartTotal);
              $('input[id="PayAmount"]').val(response.cartTotal);
              $('input[id="temporaryField"]').val(response.cartTotal);
              var rows = "";
              $.each(response.carts,function(key, value){
                rows += `
                <tr>
                  <td>${value.options.CategoryName}</td>
                  <td>${value.options.BrandName}</td>
                  <td>${value.options.SizeName}</td>
                  <td>${value.options.ThicknessName}</td>
                  <td>${value.price} * ${value.qty}</td>
                  <td> ${value.subtotal} </td>
                  <td>


                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                      ${value.qty > 1
                          ? ` <button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                          : ` <button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                      }
                      <input type="text" class="form-control custom-form-control2" min="1" value="${value.qty}">
                      <button type="button" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
                    </div>


                  </td>
                  <td>
                    <a style="cursor:pointer"  type="submit" title="delete" id="${value.rowId}" onclick="removeToCart(this.id)"><i class="fa fa-trash fa-lg delete_icon"></i></a>
                  </td>
                </tr>

                `
              });
              $('#addToCartOrderList').html(rows);

            },
        });
        /* _________ */
      }
      getOrderListInAddToCart();

      // Qunatity Increment
      function cartIncrement(rowId){
        $.ajax({
            type:'POST',
            url: "{{ route('QunatityIncrement') }}",
            data: { rowId:rowId },
            dataType:'json',
            success:function(data){
              getOrderListInAddToCart();
            }
        });
      }

      // Qunatity Decrement
      function cartDecrement(rowId){
        $.ajax({
            type:'POST',
            url: "{{ route('QunatityDecrement') }}",
            data: { rowId:rowId },
            dataType:'json',
            success:function(data){
              getOrderListInAddToCart();
            }
        });
      }

      // Remove Cart
      function removeToCart(id){
        $.ajax({
            type:'POST',
            url: "{{ route('remove-cart') }}",
            data: { id:id },
            dataType:'json',
            success:function(data){
                getOrderListInAddToCart();
                //  start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
           }
                    //  end message
            }
        });
      }
      /* ======================= Hole Seller Add to Cart ======================= */
      function wholeSelleraddToCart() {
        /* ====== Catch Value ====== */
        var CategoryId = $('select[name="CategoryID"]').val();
        var BranId = $('select[name="BranID"]').val();
        var Size = $('select[name="SizeID"]').val();
        var Thickness = $('select[name="ThicID"]').val();

        // Name
        var CategoryName = $('select[name="CategoryID"] option:selected').text();
        var BrandName = $('select[name="BranID"] option:selected').text();
        var SizeName = $('select[name="SizeID"] option:selected').text();
        var ThicknessName = $('select[name="ThicID"] option:selected').text();



        var UnitPrice = $('input[name="UnitPrice"]').val();
        var Qunatity = $('input[name="Qunatity"]').val();
        var LabourPerUnit = $('input[name="LabourPerUnit"]').val();

        /* ====== Ajax Call ====== */
        $.ajax({
            url: "{{ route('holeseller-purchase.addToCart') }}",
            type:"POST",
            dataType:"json",
            data: {
              holCategoryId:CategoryId,
              holBranId:BranId,
              holSize:Size,
              holThickness:Thickness,
              holUnitPrice:UnitPrice,
              holQunatity:Qunatity,
              holLabourPerUnit:LabourPerUnit,
              // Name
              holCategoryName:CategoryName,
              holBrandName:BrandName,
              holSizeName:SizeName,
              holThicknessName:ThicknessName,
            },
            success:function(data) {
              getHoleSellerOrderListInAddToCart();
              // Clear
              $('#CategoryId').val('');
              $('#BranId').val('');
              $('#Size').val('');
              $('#Thickness').val('');
              $('#UnitPrice').val('');
              $('#Qunatity').val('');
              $('#LabourPerUnit').val('0');
              //  start message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              })
              if($.isEmptyObject(data.error)){
                  Toast.fire({
                    type: 'success',
                    title: data.success
                  })
              }else{
                Toast.fire({
                  type: 'error',
                  title: data.error
                })
              }
              //  end message
            },
        });

        /* _________ */
      }
      /* ================= Add To Cart Order List ================= */
      function getHoleSellerOrderListInAddToCart(){
        /* ====== Ajax Call ====== */
        $.ajax({
            url: "{{ route('product-purchase-listIn.addToCart') }}",
            type:"GET",
            dataType:"json",
            success:function(response) {

              var rows = "";
              var totalLabourCost = 0;
              $.each(response.carts,function(key, value){
                totalLabourCost = totalLabourCost + value.options.holLabourPerUnit*value.qty;
                rows += `
                <tr>
                  <td>${value.options.holCategoryName}</td>
                  <td>${value.options.holBrandName}</td>
                  <td>${value.options.holSizeName}</td>
                  <td>${value.options.holThicknessName}</td>
                  <td>${value.price} * ${value.qty}</td>
                  <td> ${value.subtotal} </td>
                  <td> ${(value.options.holLabourPerUnit * value.qty).toFixed(2)} </td>
                  <td>


                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                      ${value.qty > 1
                          ? ` <button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrementInHoleSeller(this.id)">-</button>`
                          : ` <button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                      }
                      <input type="text" class="form-control custom-form-control2" min="1" value="${value.qty}">
                      <button type="button" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrementInHoleSeller(this.id)">+</button>
                    </div>


                  </td>
                  <td>
                    <a style="cursor:pointer"  type="submit" title="delete" id="${value.rowId}" onclick="removeToCartInHoleSeller(this.id)"><i class="fa fa-trash fa-lg delete_icon"></i></a>
                  </td>
                </tr>

                `
              });

              totalLabourCost = Math.round(totalLabourCost);
              var totalCost = totalLabourCost + parseFloat(response.cartTotal);
              $('input[id="LabourCost"]').val(totalLabourCost);
              $('input[id="NetAmount"]').val(totalCost);
              $('input[id="TotalCost"]').val(totalCost);
              $('input[id="temporaryField"]').val(totalCost);
              $('#holeSellerOrderList').html(rows);

            },
        });
        /* _________ */
      }
      getHoleSellerOrderListInAddToCart();

      // Remove Cart
      function removeToCartInHoleSeller(id){
        $.ajax({
            type:'POST',
            url: "{{ route('remove-cart-in.holeseller') }}",
            data: { id:id },
            dataType:'json',
            success:function(data){
                getHoleSellerOrderListInAddToCart();
                //  start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
           }
                    //  end message
            }
        });
      }
      // Cart Increment
      function cartIncrementInHoleSeller(rowId){
        $.ajax({
            type:'POST',
            url: "{{ route('QunatityIncrementInHoleSeller') }}",
            data: { rowId:rowId },
            dataType:'json',
            success:function(data){
              getHoleSellerOrderListInAddToCart();
            }
        });
      }
      // Cart Decrement
      function cartDecrementInHoleSeller(rowId){
        $.ajax({
            type:'POST',
            url: "{{ route('cartDecrementInHoleSeller') }}",
            data: { rowId:rowId },
            dataType:'json',
            success:function(data){
              getHoleSellerOrderListInAddToCart();
            }
        });
      }






    </script>


     </script>
     <script type="text/javascript">
        $(document).ready(function() {
          $('select[name="DiviId"]').on('change', function(){
              var DiviId = $(this).val();
              // alert(DiviId);
              if(DiviId) {

                  $.ajax({
                      url: "{{ route('Division-wise-District') }}",
                      type:"POST",
                      dataType:"json",
                      data: { DiviId:DiviId },
                      success:function(data) {


                          if(data == ""){
                           $('select[name="DistId"]').empty();
                           $('select[name="DistId"]').append('<option value="">Data Not Found! </option>');

                            $('select[name="ThanId"]').empty();
                           $('select[name="ThanId"]').append('<option value="">Data Not Found! </option>');

                         }else{
                           $('select[name="DistId"]').empty();
                           $('select[name="DistId"]').append('<option value="">Select District</option>');

                            $('select[name="ThanId"]').empty();
                           $('select[name="ThanId"]').append('<option value="">Select District</option>');

                           $.each(data, function(key, value){
                                $('select[name="DistId"]').append('<option value="'+ value.DistId +'">' + value.DistName+ '</option>');
                            });
                         }


                      },

                  });
              } else{

              }
          });
          // District
          $('select[name="DistId"]').on('change', function(){
              var DistId = $(this).val();
              // alert(DistId);
              if(DistId) {
                  $.ajax({
                      url: "{{ route('District-wise-thana') }}",
                      type:"POST",
                      dataType:"json",
                      data: { DistId:DistId },
                      success:function(data) {


                         // $('select[name="DistId"]').empty();
                         // $('select[name="ThanId"]').empty();

                         if(data == ""){

                           $('select[name="ThanId"]').empty();
                           $('select[name="ThanId"]').append('<option value="">Data Not Found! </option>');

                         }else{

                           $('select[name="ThanId"]').empty();
                           $('select[name="ThanId"]').append('<option value="">Select Thana</option>');


                           $.each(data, function(key, value){
                                $('select[name="ThanId"]').append('<option value="'+ value.ThanId +'">' + value.ThanaName + '</option>');
                            });;
                         }


                      },

                  });
              } else{

              }
          });


           // Thana
          $('select[name="ThanId"]').on('change', function(){
              var ThanId = $(this).val();
              if(ThanId) {
                  $.ajax({
                      url: "{{ route('Thana-wise-union') }}",
                      type:"POST",
                      dataType:"json",
                      data: { ThanId:ThanId },
                      success:function(data) {


                         if(data == ""){

                           $('select[name="UnioId"]').empty();
                           $('select[name="UnioId"]').append('<option value="">Data Not Found! </option>');

                         }else{

                           $('select[name="UnioId"]').empty();
                           $('select[name="UnioId"]').append('<option value="">Select Union</option>');


                           $.each(data, function(key, value){
                                $('select[name="UnioId"]').append('<option value="'+ value.UnioId +'">' + value.UnioName + '</option>');
                            });
                         }

                      },

                  });
              } else{

              }
          });


      });

  </script>


  <script>
    function updateDrVouchar(id){
        // alert(id);
        $.ajax({
          type: 'POST',
          url: "{{ route('DebitVoucher.edit') }}",
          dataType: 'json',
          data: { id:id },
          success: function(response){
            $('input[id="VoucharNo"]').val(response.data.VoucherId);
            $('input[id="Amount"]').val(response.data.Amount);
            $('input[id="Date"]').val(response.data.	ExpenseDate);
            $('input[id="id"]').val(response.data.	DrVoucId);

            $('select[name="Purpose"]').empty();
            $('select[name="Purpose"]').append('<option value="'+ response.data.DrTypeId +'">' + response.data.DrTypeId + '</option>');

            $('select[name="DebitedTo"]').empty();
            $('select[name="DebitedTo"]').append('<option value="'+ response.data.DebitedTold +'">' + response.data.DebitedTold + '</option>');

            $('select[name="CreditedFromId"]').empty();
            $('select[name="CreditedFromId"]').append('<option value="'+ response.data.CreditedFromId +'">' + response.data.CreditedFromId + '</option>');


          }
        })
      }
  </script>


  <script>
    $(document).ready(function(){
      $(document).on("click", "#addPayment", function () {

        var softDel = $(this).data('id');
        var amount = $(this).data('customer_amount');
        var name = $(this).data('name');
        var trade = $(this).data('trade');
        var phone = $(this).data('phone');
        // alert(name);
        $(".modal_card #modal_id").val( softDel );
        $(".modal_card #DueAmount").val( amount );
        $(".modal_card #custName").text( name );
        $(".modal_card #tradeName").text( trade );
        $(".modal_card #custPhone").text( phone );
      });
    })
  </script>

<script>
    $(document).ready(function () {
    $('#dtHorizontalExample').DataTable({
    "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option'
        });
        $('#retailer-select').select2({

        });

    });
</script>
  </body>
</html>
