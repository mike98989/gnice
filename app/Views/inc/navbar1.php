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
              <p class="top-message mb-0 mr-lg-5 pr-3  d-sm-block">
                Welcome <?php echo $_SESSION['user_name']?>!
              </p>
              <div class="header-dropdown dropdown-expanded mr-3">
                <a href="#">Links</a>
                <div class="header-menu">
                  <ul>

                    
                    <li><a href="About">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="Contact">Contact</a></li>
                    <li><a href="About">Help &amp; FAQs</a></li>
                     <li><a href="Login">Sell</a></li>

                  </ul>
                </div>
                <!-- End .header-menu -->
              </div>
              <!-- End .header-dropown -->

              <span class="separator"></span>

              <div class="social-icons">
                <a
                  href="#"
                  class=""
                 
                >Logout</a>
                <a
                  href="#"
                  class="social-icon social-twitter icon-twitter"
                  target="_blank"
                ></a>
                <a
                  href="#"
                  class="social-icon social-facebook icon-facebook"
                  target="_blank"
                ></a>
              </div>
              <!-- End .social-icons -->
            </div>
            <!-- End .header-right -->
          </div>
          <!-- End .container -->
        </div>
        <!-- End .header-top -->

       
         

  
      </header>
      <!-- End .header -->