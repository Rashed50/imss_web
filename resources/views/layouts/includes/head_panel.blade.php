<!-- ########## START: HEAD PANEL ########## -->
<div class="sl-header">
  <div class="sl-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
  </div><!-- sl-header-left -->
  <div class="sl-header-right">
    <nav class="nav">
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name">{{ Auth::user()->name}} **<span class="hidden-md-down"> {{Auth::user()->email}}</span></span>
          <img src="{{ asset('content/admin') }}/assets/img/img3.jpg" class="wd-32 rounded-circle" alt="">
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
            <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
            <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>
            <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>
            <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="icon ion-power"></i><span>Logout</span></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
    <div class="navicon-right">
      <a id="btnRightMenu" href="" class="pos-relative">
        <i class="icon ion-ios-bell-outline"></i>
        <!-- start: if statement -->
        <span class="square-8 bg-danger"></span>
        <!-- end: if statement -->
      </a>
    </div><!-- navicon-right -->
  </div><!-- sl-header-right -->
</div><!-- sl-header -->
<!-- ########## END: HEAD PANEL ########## -->
