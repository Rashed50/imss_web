<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <!-- vendor css -->
    <link href="{{ asset('contents/admin') }}/assets/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('contents/admin') }}/assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/toast/toast.css" rel="stylesheet">
    <!-- dataTables css -->
    <link href="{{ asset('contents/admin') }}/assets/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/starlight.css">
    <link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/style.css">
    <script src="{{ asset('contents/admin') }}/assets/lib/jquery/jquery.js"></script>
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
    <!-- <footer class="sl-footer-custom">
      <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2021. 3iengineers.com</div>
      </div>
    </footer> -->
    <!-- script file -->

    <script src="{{ asset('contents/admin') }}/assets/lib/popper.js/popper.js"></script>
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

    <script src="{{ asset('contents/admin') }}/assets/lib/Flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/toast/toast.min.js"></script>
    <script>
      @if(Session::has('message'))
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
    @endif
    </script>

    <script src="{{ asset('contents/admin') }}/assets/lib/flot-spline/jquery.flot.spline.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/starlight.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/ResizeSensor.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/js/custom.js"></script>
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
                           $('select[name="BranId"]').empty();
                           $('select[name="BranId"]').append('<option value="">Data Not Found! </option>');

                           $('select[name="Size"]').empty();
                           $('select[name="Size"]').append('<option value="">Data Not Found!</option>');

                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Data Not Found!</option>');

                         }else{
                           $('select[name="BranId"]').empty();
                           $('select[name="BranId"]').append('<option value="">Select Brand</option>');

                           $('select[name="Size"]').empty();
                           $('select[name="Size"]').append('<option value="">Select Size</option>');

                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Select Thickness</option>');

                           $.each(data, function(key, value){
                              $('select[name="BranId"]').append('<option value="'+ value.BranId+'">' + value.BranName + '</option>');
                           });
                         }

                      },

                  });
              } else{

              }
          });
          // Brand Wise productSize
          $('select[name="BranId"]').on('change', function(){
              var BranId = $(this).val();
              if(BranId) {
                  $.ajax({
                      url: "{{ route('Brand-wise-size') }}",
                      type:"POST",
                      dataType:"json",
                      data: { BranId:BranId },
                      success:function(data) {
                         if(data == ""){
                           $('select[name="Size"]').empty();
                           $('select[name="Size"]').append('<option value="">Data Not Found! </option>');

                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Data Not Found!</option>');
                         }else{
                           $('select[name="Size"]').empty();
                           $('select[name="Size"]').append('<option value="">Select Size</option>');

                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Select Thickness</option>');
                           $.each(data, function(key, value){
                              $('select[name="Size"]').append('<option value="'+ value.SizeId+'">' + value.SizeName+ '</option>');
                           });
                         }

                      },
                  });
              } else{

              }
          });
          // product Size Wise Thickness
          $('select[name="Size"]').on('change', function(){
              var Size = $(this).val();
              if(Size) {
                  $.ajax({
                      url: "{{ route('size-wise-thickness') }}",
                      type:"POST",
                      dataType:"json",
                      data: { Size:Size },
                      success:function(data) {
                         if(data == ""){
                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Data Not Found! </option>');
                         }else{
                           $('select[name="Thickness"]').empty();
                           $('select[name="Thickness"]').append('<option value="">Select Size</option>');
                           $.each(data, function(key, value){
                              $('select[name="Thickness"]').append('<option value="'+ value.ThicId+'">' + value.ThicName+ '</option>');
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
                         $('input[id="predueAmount"]').val(data.DueAmount);
                         $('#holeCustomerImage').prop("src", data.Photo);
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
        var BranId = $('select[name="BranId"]').val();
        var Size = $('select[name="Size"]').val();
        var Thickness = $('select[name="Thickness"]').val();

        // Name
        var CategoryName = $('select[name="CategoryID"] option:selected').text();
        var BrandName = $('select[name="BranId"] option:selected').text();
        var SizeName = $('select[name="Size"] option:selected').text();
        var ThicknessName = $('select[name="Thickness"] option:selected').text();



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

        /* ___________________________ */
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
        /* ___________________________ */
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
      function holeSelleraddToCart() {
        /* ====== Catch Value ====== */
        var CategoryId = $('select[name="CategoryID"]').val();
        var BranId = $('select[name="BranId"]').val();
        var Size = $('select[name="Size"]').val();
        var Thickness = $('select[name="Thickness"]').val();

        // Name
        var CategoryName = $('select[name="CategoryID"] option:selected').text();
        var BrandName = $('select[name="BranId"] option:selected').text();
        var SizeName = $('select[name="Size"] option:selected').text();
        var ThicknessName = $('select[name="Thickness"] option:selected').text();



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
              $('#LabourPerUnit').val('');
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

        /* ___________________________ */
      }
      /* ================= Add To Cart Order List ================= */
      function getHoleSellerOrderListInAddToCart(){
        /* ====== Ajax Call ====== */
        $.ajax({
            url: "{{ route('product-purchase-listIn.addToCart') }}",
            type:"GET",
            dataType:"json",
            success:function(response) {
              $('input[id="NetAmount"]').val(response.cartTotal);
              $('input[id="TotalCost"]').val(response.cartTotal);
              $('input[id="temporaryField"]').val(response.cartTotal);
              var rows = "";
              $.each(response.carts,function(key, value){
                rows += `
                <tr>
                  <td>${value.options.holCategoryName}</td>
                  <td>${value.options.holBrandName}</td>
                  <td>${value.options.holSizeName}</td>
                  <td>${value.options.holThicknessName}</td>
                  <td>${value.price} * ${value.qty}</td>
                  <td> ${value.subtotal} </td>
                  <td> ${value.options.holLabourPerUnit} </td>
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
              $('#holeSellerOrderList').html(rows);

            },
        });
        /* ___________________________ */
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


      // Qunatity Decrement
      // function cartDecrement(rowId){
      //   $.ajax({
      //       type:'POST',
      //       url: "",
      //       data: { rowId:rowId },
      //       dataType:'json',
      //       success:function(data){
      //         getOrderListInAddToCart();
      //       }
      //   });
      // }








    </script>
  </body>
</html>
