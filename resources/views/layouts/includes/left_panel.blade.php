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
    <a href="index.html" class="sl-menu-link active">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
      <!-- menu-item -->
    </a>
    <!-- sl-menu-link -->

    <!-- single menu -->
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Charts</span>
      </div>
    </a>

    <a href="{{ route('vendor.add') }}" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
          <span class="menu-item-label">Vendor</span>
        </div>
      </a>
    <!-- single menu -->


    <!-- multiple menu -->
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Purchase</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('category.add') }}" class="nav-link">Category</a></li>
      <li class="nav-item"><a href="{{ route('brand.add') }}" class="nav-link">Brand</a></li>
      <li class="nav-item"><a href="{{ route('size.add') }}" class="nav-link">Size</a></li>
      <li class="nav-item"><a href="{{ route('thickness.add') }}" class="nav-link">Thickness</a></li>
      <li class="nav-item"><a href="{{ route('stock.add') }}" class="nav-link">Stock</a></li>
    </ul>
    <!-- multiple menu -->

    <!-- multiple menu -->
    <a href="#" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Purchase</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <!-- sl-menu-link -->
     <!-- 01749806802 -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="#" class="nav-link">add Here</a></li>
    </ul>
    <!-- multiple menu -->



  </div>
  <!-- sl-sideleft-menu -->

  <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->
