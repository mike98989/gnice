
 <div class="container-scroller" ng-controller="headerController">
  <div>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="" href="#"><img width="30px"; src="<?php echo APP_URL;?>/public/assets/images/gnice_logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="#"></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
     
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php echo APP_URL;?>/public/assets/images/uploads/profile/{{user_data.image}}" alt="profile"/>
              <span class="nav-profile-name">{{user_data.fullname}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="{{dirlocation}}logout">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
           <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}home">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Main Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}dashboard/home">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}dashboard/add_product">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">New Product</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}dashboard/my_products">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">My Product</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}dashboard/messages">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Client Responses</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}dashboard/profile">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">My Profile</span>
            </a>
          </li>
            <li class="nav-item" style="display:none">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="EditProfile">Edit Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="changepassword">Change Password</a></li>
              </ul>
            </div>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="{{dirlocation}}logout">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Log out</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">