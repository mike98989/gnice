 <footer class="footer bg-dark" >
        <div class="footer-middle">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                <div class="widget">
                  <h4 class="widget-title">About Us</h4>
                  <img
                    src="<?php echo APP_URL;?>/assets/images/logo-footer.png"
                    alt="Logo"
                    class="m-b-3"
                  />
                  <p class="m-b-4 pb-1">
                    It is the biggest free online classified with an advanced security system. We provide a simple hassle-free solution to sell and buy almost anything.
                  </p>
                  <a href="About" class="read-more text-white">read more...</a>
                </div>
                <!-- End .widget -->
              </div>
              <!-- End .col-lg-3 -->

              <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                <div class="widget">
                  <h4 class="widget-title mb-1 pb-1">Our App</h4>
               
                  <div class="social-icons">
                    <a
                      href="#"
                      class="social-icon social-facebook fab fa-facebook-f"
                      target="_blank"
                      title="Facebook"
                    ></a>
                    <a
                      href="#"
                      class="social-icon social-twitter fab fa-twitter"
                      target="_blank"
                      title="Twitter"
                    ></a>
                    <a
                      href="#"
                      class="social-icon social-linkedin fab fa-linkedin-in"
                      target="_blank"
                      title="Linkedin"
                    ></a>
                  </div>
                  <!-- End .social-icons -->
                </div>
                <!-- End .widget -->
              </div>
              <!-- End .col-lg-3 -->

              <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                <div class="widget">
                  <h4 class="widget-title pb-1">Our Resources</h4>

                  <ul class="links">
                    <li><a href="#">Our Blog</a></li>
                    <li><a href="#">Gnice on Facebook</a></li>
                    <li><a href="#">Our Instagram</a></li>
                    <li><a href="#">Our Youtube</a></li>
                    <li><a href="#">Our Twitter</a></li>
                    
                  </ul>
                </div>
                <!-- End .widget -->
              </div>
              <!-- End .col-lg-3 -->

                  <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
                <div class="widget">
                  <h4 class="widget-title pb-1">Customer Service</h4>

                  <ul class="links">
                    <li><a href="#">Help & FAQs</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Billing Policy</a></li>
                    <li><a href="#">Gnice Tip</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="about.html">Contact Us</a></li>
                    <li><a href="#">Gince Sellers</a></li>
                    <li><a href="#">Privacy</a></li>
                  </ul>
                </div>
                <!-- End .widget -->
              </div>
              <!-- End .col-lg-3 -->

           
            </div>
            <!-- End .row -->
          </div>
          <!-- End .container -->
        </div>
        <!-- End .footer-middle -->

        <div class="container">
          <div
           align="center"
          >
            <p class="footer-copyright py-3 pr-4 mb-0">
              © Gnice Market Place. <script type="text/javascript"> var d = new Date(); var y = d.getFullYear(); document.write(y);</script>. All Rights Reserved
            </p>

           
          </div>
        </div>
        <!-- End .container -->
      </footer>
      <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container" ng-controller="homeController">
      <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
           <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>
          <ul class="mobile-menu menu"  ng-init="fetch_all_categories_and_sub_categories()">
                     <li  ng-repeat="catSub in catSubs">
                  <a href="#">{{catSub.title}}</a>
                  <ul>
                     <li  ng-repeat="sub in catSub.subcategory ">
                                        <a style="color: black!important;" href="#" class="cbtn" data-id4="{{sub.sub_id}}"  data-id5="{{sub.parent_id}}" >{{ sub.title }} </a></li>
                   
                    </ul>
                   </li>
         
          
          </ul>

        
        </nav>
        <!-- End .mobile-nav -->

     
        <!-- End .social-icons -->
      </div>
      <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <!-- Add Cart Modal -->
    <div
      class="modal fade"
      id="addCartModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addCartModal"
      aria-hidden="true"
      ng-controller="homeController"

    >
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-body add-cart-box text-center">
            <p>Contact Seller</p>
            <h4 id="productTitle"></h4>
          
           

            <img
              src="#"
              id="productImage"
              width="100"
              height="100"
              alt="adding cart image"
            />
            
            <div class="btn-actions">
            
              <a href="tel:+2348149150368"
                ><button class="btn-primary"> +234 (0) 8149150368</button></a
              >
              <a href="#"
                ><button class="btn-primary" data-dismiss="modal">
                  Continue
                </button></a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"
      ><i class="icon-angle-up"></i
    ></a>

    <!-- Plugins JS File -->
    <script src="<?php echo APP_URL;?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/jquery.bootstrap.wizard.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/gsdk-bootstrap-wizard.js"></script>
     <script src="<?php echo APP_URL;?>/assets/js/jquery.validate.min.js"></script>
     
    <script src="<?php echo APP_URL;?>/assets/js/plugins.min.js"></script>

    <!-- Main JS File -->
    <script src="<?php echo APP_URL;?>/assets/js/main.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/custom-js/signup.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-route.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/dirPagination.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-sanitize.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-cookies.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/ngStorage.min.js"></script>
    <!----MODULE-->
    <script src="<?php echo APP_URL.'/assets/js/controllers/module.js';?>"></script>

  <?php
  if (isset($js)) {
    foreach ($js as $jsfile) {
      echo "<script src=".APP_URL."/assets/js/".$jsfile."></script>";
    }
  }
//////EXTERNAL JAVASCRIPT
  if (isset($external_js)) {
    foreach ($external_js as $external_jsfile) {
      echo "<script type='text/javascript' src=".$external_jsfile."></script>";
    }
  }
?>
<script src="<?php echo APP_URL.'/assets//js/controllers/directives.js';?>"></script>
<script type="text/javascript">
   
</script>

  </body>

  <!-- Mirrored from portotheme.com/html/porto_ecommerce/demo_6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Jun 2021 16:56:10 GMT -->
</html>