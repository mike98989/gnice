

    <div class="page-wrapper" style="background-color: #efefef;">
      <header class="header"  ng-controller="homeController" style="background-color: rgba(236, 234, 234, 1);">
        <div class="header-top bg-primary text-uppercase">
          <div class="container">
            <div class="header-left">
              <a href="<?php echo APP_URL;?>" class="logo">
                <img src="<?php echo APP_URL;?>/public/assets/images/gnice_logo.png" style="width:40px;"/>
              </a>
              
              <span style="font-size:13px;display:none">GNICE MARKET PLACE </span>
              <!-- End .header-dropown -->
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto" ng-init="fetch_all_categories_and_sub_categories()">
              <div class="header-dropdown dropdown-expanded mr-3">
                <a href="#">Links</a>
                <div class="header-menu">
                  <ul>

                  
                  <li><a href="<?php echo APP_URL;?>/home">Home</a></li>
                    <li><a href="<?php echo APP_URL;?>/about">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="{{dirloation}}contact">Contact</a></li>
                    <li><a href="<?php echo APP_URL;?>/dashboard/add_product">Sell</a></li>
                    <li ng-if="user_data">
                  <a href="{{dirlocation}}dashboard/home">
                <img src="{{dirlocation}}public/assets/images/uploads/profile/{{user_data.image}}" style="width:25px;height:25px;border-radius:20px;border:1px solid #fff"/>
                    
                  </a>
                  </li>  
                  </ul>
                </div>
                <!-- End .header-menu -->
              </div>
              <!-- End .header-dropown -->

              <span class="separator"></span>

              <div class="social-icons">
                <a
                  href="#"
                  class="social-icon social-instagram icon-instagram"
                  target="_blank"
                ></a>
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
    <?php if(($url[1]=='home')||($url[1]=='')){?>
        <div class="header-middle" style="display:nne;height:auto;padding-bottom:0;padding-top:0">
          <div class="container">
            <div class="header-left col-lg-3 w-auto pl-0" style="text-align: center;">
              <button class="mobile-menu-toggler mr-2" type="button">
                <i class="icon-menu"></i>
              </button>
              <img src="<?php echo APP_URL;?>/public/assets/images/man2_greyscale.png" style="display:nne;width:200px;margin:0 auto;float:none">
            </div>
            <div class="header-right w-lg-max pl-2">
              <div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
              <h6 class="pt-1 line-height-1" style="text-align: center;">
                  Search For Anything
                </h6>
                <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                <form method="get" action="<?php echo APP_URL;?>/search">
                  <div class="header-search-wrapper">
                    <input ng-model="searchText" type="text" required class="form-control" name="query" placeholder="Search..."/>
                    <div class="select-custom" >
                      <select id="cat" name="sub_cat"  ng-init="fetch_all_categories_and_sub_categories()" >
                        <option   value="">All Categories</option>
                        <optgroup  ng-repeat="catSub in catSubs" label=" - {{catSub.title}}">
                          <option  ng-repeat="sub in catSub.subcategory" value="{{ sub.sub_id }}">{{ sub.title }}</option>
                        </optgroup>
                       
                      </select>
                    </div>
                    <button class="btn2 p-0 icon-search-3" style="cursor: pointer" type="submit"></button>
                  </div>
                </form>
                  <!-- End .header-search-wrapper -->
           
              </div>
              <!-- End .header-search -->

              <div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-3 ml-xl-5">
                
                <i class="icon-email"></i>
                <h6 class="pt-3 line-height-1">
              Email us now<a
                    href="email"
                    class="d-block text-dark ls-10 pt-1"
                    >gnice.market@gmail.com</a
                  >
                </h6> 
              </div>
 
              
              <!-- End .header-contact -->
            <!-- End .header-right -->
          </div>
          <!-- End .container -->
        </div>
        <!-- End .header-middle -->
</div>
<?php }else{?>
<div class="header-middle text-dark">
        <div class="container">
          
          <div class="header-right w-lg-max pl-2">
            <div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
              <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
              <form method="get" action="<?php echo APP_URL;?>/search">
                <div class="header-search-wrapper">
                  <input type="search" class="form-control" name="query" required id="q" placeholder="Search Products, Brands and Categories" value="<?php if(isset($_GET['query'])){echo $_GET['query'];}?>" required>
                  <div class="select-custom">
                    <select id="cat" name="sub_cat" ng-init="fetch_all_categories_and_sub_categories()" >
                        <option   value="">All Categories</option>
                        <optgroup  ng-repeat="catSub in catSubs" label=" - {{catSub.title}}">
                          <option  ng-repeat="sub in catSub.subcategory" value="{{ sub.sub_id }}">{{ sub.title }}</option>
                        </optgroup>
                      </select>
                  </div><!-- End .select-custom -->
                  <button class="btn2 p-0 icon-search-3" style="cursor: pointer" type="submit"></button>
                </div><!-- End .header-search-wrapper -->
              </form>
            </div><!-- End .header-search -->

            <div class="d-none d-lg-flex align-items-center">
              <a ng-if="!user_data" href="{{dirlocation}}login">Sign In</a>
              <a ng-if="!user_data" href="{{dirlocation}}signup"> &nbsp; | Registration &nbsp; &nbsp;</a>
              <button type="button" class="btn btn-primary btn-sm" style="border-radius: 25px;"><a href="{{dirlocation}}dashboard/add_product">SELL</a></button>
            </div>
          
            <!-- End .header-contact -->

          </div><!-- End .header-right -->
        </div><!-- End .container -->
      </div><!-- End .header-middle -->

<?php }?>
        <!-- <div class="sticky-header d-none d-lg-block" ng-init="fetch_all_categories_and_sub_categories()">
          <div class="container">
            <nav class="main-nav w-100">
              <ul class="menu">
                <li class="active">
                  <a href="<?php echo APP_URL;?>/home">Home</a>
                </li>
                <li>
                  <a href="#">Categories</a>
                  <ul>
                    <li ng-repeat="catSub in catSubs">
                      <a href="#">{{catSub.title}}</a>
                      <ul>
                        <li ng-repeat="sub in catSub.subcategory">
                          <a href="checkout-shipping.html">{{ sub.title }}</a>
                        </li>
                      </ul>
                    </li>
                    
                  </ul>
                </li>
                <li><a href="#">Blog</a></li>
                <li><a href="About">About Us</a></li>
                <li><a href="contact">Contact Us</a></li>
                <li class="float-right">
                  <a href="Login" target="_blank"
                    >PLACE ADS<span class="tip tip-new tip-top">New</span></a
                  >
                </li>
                
              </ul>
            </nav>
          </div>
         
        </div> -->
        <!-- End .header-bottom -->
      </header>
      <!-- End .header -->