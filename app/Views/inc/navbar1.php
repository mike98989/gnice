   <?php
if (!isset($_SESSION['user_name'])) {
  header("location: Home");
}
?>

    <div class="page-wrapper">
      <header class="header"  ng-controller="homeController">
        <div class="header-top bg-primary text-uppercase">
          <div class="container">
            <div class="header-left">

              <div class="header-dropdown">
               
                <!-- End .header-menu -->
              </div>
              <!-- End .header-dropown -->
         <!--
              <div class="header-dropdown ml-4">
                <a href="#">USD</a>
                <div class="header-menu">
                  <ul>
                    <li><a href="#">EUR</a></li>
                    <li><a href="#">USD</a></li>
                  </ul>
                </div>
               
              </div>
            -->
              <!-- End .header-dropown -->
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto">
           
                  <p class="top-message mb-0 mr-lg-5 pr-3 d-none d-sm-block">Welcome <?php echo $_SESSION['user_name'];?></p>
            <ul class="d-flex mb-0 mr-3 pr-3 menu" style="margin-top: -20px!important;">
                  <li class=" mr-3"><a href="Premium" class="social-icon social-instagram icon-instagram" title="Premium Services"></a></li>
                  <li class=" mr-3"><a href="Advert" class="social-icon social-instagram icon-instagram" title="Advert"></a></li>
                  <li class=" mr-3"><a href="Messages" class="social-icon social-instagram icon-instagram" title="My Messages"></a></li>
                  <li class=" mr-3"><a href="Saved" class="social-icon social-instagram icon-instagram" title="Saved"></a></li>
                   <li>
                  <a href="#" class="social-icon social-instagram icon-instagram" title="Profile">Profile</a>
                  <ul>
                    <li><a href="Dashboard">My Page</a></li>
                    <li><a href="Balance">My Balance</a></li>
                    <li><a href="Statistics">Statistics</a></li>
                    <li><a href="Notification">Notification</a></li>
                  
                    <li><a href="Setting" >Setting</a></li>
                    <li ng-controller="loginController"><a href="" ng-click="logout()">Logout</a></li>
                    </ul>
                   </li>
                </ul>
              <!-- End .header-dropown -->

           
              <!-- End .social-icons -->
            </div>
            <!-- End .header-right -->
          </div>
          <!-- End .container -->
        </div>
        <!-- End .header-top -->

       
         

  
      </header>
      <!-- End .header -->