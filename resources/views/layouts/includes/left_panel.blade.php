<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> IMSS Software </a></div>
<div class="sl-sideleft">

  <!-- <div class="input-group input-group-search">
    <input type="search" name="search" class="form-control" placeholder="Search">
    <span class="input-group-btn">
      <button class="btn"><i class="fa fa-search"></i></button>
    </span>
  </div> -->
  <!-- input-group -->


  <div class="sl-sideleft-menu">
    <a href="{{url('/')}}" class="sl-menu-link active">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
      <!-- menu-item -->
    </a>
    <!-- sl-menu-link -->

   <!-- customer menu -->
  <a href="#" class="sl-menu-link @yield('customer')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Customer</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
  </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('customer.add') }}" class="nav-link @yield('customer-add')">New Customer</a></li>
      <li class="nav-item"><a href="{{ route('customer.type.add') }}" class="nav-link @yield('customer-type')">Customer TYpe</a></li>
      <li class="nav-item"><a href="{{ route('customer.list') }}" class="nav-link @yield('customer-type')">Customer List</a></li>
      <li class="nav-item"><a href="#" class="nav-link @yield('customer-type')">Customer Search</a></li>
    </ul>

          <!-- multiple menu -->
          <a href="#" class="sl-menu-link @yield('Product-sell')">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Item Sales</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('Product.Hole.Seller') }}" class="nav-link @yield('whole-sell')">Whole Sale</a></li>
          <li class="nav-item"><a href="{{ route('Product.Retailer.Seller') }}" class="nav-link @yield('retrail-sell')">Retrail Sale</a></li>
          <li class="nav-item"><a href="{{ route('sell.info') }}" class="nav-link @yield('sell-info')">Sales Records</a></li>
          <li class="nav-item"><a href="#" class="nav-link @yield('sell-info')"> Search Sales Record</a></li>
          <li class="nav-item"><a href="{{ route('sell.return') }}" class="nav-link @yield('Sale-Return')">Sale Return</a></li>
          
        </ul>


        <a href="#" class="sl-menu-link @yield('Sell-Details')">
         <div class="sl-menu-item">
           <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
           <span class="menu-item-label">Sell-Info </span>
           <i class="menu-item-arrow fa fa-angle-down"></i>
         </div>
       </a>
       <!-- sl-menu-link -->
       <ul class="sl-menu-sub nav flex-column">
         <li class="nav-item"><a href="{{ route('customer.type-wise.sell-details.list') }}" class="nav-link @yield('Customer-Sell')">Customer Sell</a></li>
       </ul>


      <a href="#" class="sl-menu-link @yield('payment-info')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Payment</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('due.payment.add')}}" class="nav-link @yield('due-payment')">New Payment</a></li>
      <li class="nav-item"><a href="{{ route('payment.customer.list') }}" class="nav-link @yield('customer-payment')">Customer Payment</a></li>
      <li class="nav-item"><a href="" class="nav-link @yield('customer-payment-record')">Customer Payment Record</a></li>
      <li class="nav-item"><a href="" class="nav-link @yield('customer-payment')">Vendor Payment</a></li>
      <li class="nav-item"><a href="" class="nav-link @yield('customer-payment')">Salary Payment(Employee) </a></li>
      <li class="nav-item"><a href="{{ route('customer.payment') }}" class="nav-link @yield('customer-payment')">Payment</a></li>
    </ul>


  
  <!-- Vendor -->
  
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Vendor</span>

        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
         <li class="nav-item"><a href="{{ route('vendor.add') }}" class="nav-link @yield('Vendor')">New Venodr</a></li>
         <li class="nav-item"><a href="#" class="nav-link @yield('Vendor Report')">Vendor Report</a></li>
        
    </ul>

 
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Items Purchase</span>

        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('category.add') }}" class="nav-link">Add Category</a></li>
      <li class="nav-item"><a href="{{ route('brand.add') }}" class="nav-link">Add Brand</a></li>
      <li class="nav-item"><a href="{{ route('size.add') }}" class="nav-link">Add Size</a></li>
      <li class="nav-item"><a href="{{ route('thickness.add') }}" class="nav-link">Add Thickness</a></li>
      <li class="nav-item"><a href="{{ route('labour.add') }}" class="nav-link">Set Labour Cost</a></li>
      <li class="nav-item"><a href="{{ route('stock.add') }}" class="nav-link">New Stock</a></li>
      <li class="nav-item"><a href="{{ route('product.purchase.add') }}" class="nav-link">New Purchase</a></li>
    </ul>

 
 <!-- Voucher -->
          <a href="#" class="sl-menu-link @yield('Voucher')">
         <div class="sl-menu-item">
           <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
           <span class="menu-item-label">Accounts </span>
           <i class="menu-item-arrow fa fa-angle-down"></i>
         </div>
       </a>
       <!-- sl-menu-link -->
       <ul class="sl-menu-sub nav flex-column">
         <li class="nav-item"><a href="{{ route('DebitVoucher.add') }}" class="nav-link @yield('debit-voucher')">Debit Voucher</a></li>
         <li class="nav-item"><a href="{{ route('CreitVoucher.add') }}" class="nav-link @yield('credit-voucher')">Credit Voucher</a></li>
         <li class="nav-item"><a href="#" class="nav-link @yield('credit-voucher')">New Account Head</a></li>
       </ul>

      <!-- multiple menu -->
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>

        <span class="menu-item-label">Admin Setting </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{ route('company.add') }}" class="nav-link">Company Profile</a></li>
      <li class="nav-item"><a href="{{ route('division.add') }}" class="nav-link">Add Division</a></li>
      <li class="nav-item"><a href="{{ route('district.add') }}" class="nav-link">Add District</a></li>
      <li class="nav-item"><a href="{{ route('thana.add') }}" class="nav-link">Add Thana</a></li>
      <li class="nav-item"><a href="{{ route('union.add') }}" class="nav-link">Add Union</a></li>
      <li class="nav-item"><a href="#" class="nav-link @yield('add-employee')">Add Designation</a></li>
      <li class="nav-item"><a href="{{ route('employee.add') }}" class="nav-link @yield('add-employee')">Add Employee</a></li>
    </ul>


  </div>
  <!-- sl-sideleft-menu -->

  <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->
