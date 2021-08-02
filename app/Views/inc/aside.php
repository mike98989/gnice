<div class="sidebar-overlay"></div>
<div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
<aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
    <div class="side-menu-wrapper text-uppercase mb-2 d-lg-block d-none">
        <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>

        <nav class="side-nav">

<!--
            <ul class="menu menu-vertical sf-arrows"  ng-init="fetch_all_categories_and_sub_categories()">
            <li ng-repeat="catSub in catSubs">
            <a href="#"  class="sf-with-ul"><img style="width: 20px!important; height: 20px!important;" src="assets/images/uploads/category/{{catSub.image}}">{{catSub.title}} <span>({{ catSub.subcategory.length | number}} ad)</span></a>
           
            
                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                        <div class="row" >
                            <div class="col-lg-6" >
                                <a href="#" class="nolink">{{catSub.title}} <span>({{ catSub.subcategory.length | number}} ad)</span></a>
                                <ul class="submenu" >
                                    <li  ng-repeat="sub in catSub.subcategory ">
                                        <a href="#" class="cbtn" data-id4="{{sub.sub_id}}"  data-id5="{{sub.parent_id}}" ><img style="width: 20px!important; height: 20px!important;" src="assets/images/uploads/category/{{sub.image}}">{{$index + 1}} {{ sub.title }} </a></li>
                                    </ul>
                                -->
                                   
            <ul class="menu menu-vertical sf-arrows" ng-init="fetch_all_categories_and_sub_categories()">
                <li ng-repeat="catSub in catSubs">
                    <a href="#" class="sf-with-ul"><i class="sicon-badge"></i>{{catSub.title}}</a>
                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="nolink">{{catSub.title}}</a>
                                <ul class="submenu">
                                    <li ng-repeat="sub in catSub.subcategory ">
                                        <a href="#" class="cbtn" data-id4="{{sub.sub_id}}" data-id5="{{sub.parent_id}}">{{ sub.title }} </a>
                                    </li>
                                </ul>


                            </div>

                            <div class="col-lg-6 p-0">
                                <img src="assets/images/menu-banner.jpg" alt="Menu banner">
                            </div>
                        </div>
                    </div><!-- End .megamenu -->
                </li>
                <!-- CATEGORY LOOP ENDS HERE -->
                <!--
                <li>
                    <a href="category.html" class="sf-with-ul"><i class="sicon-badge"></i>Vehicles</a>
                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="#" class="nolink">VARIATION 1</a>
                                <ul class="submenu">
                                    <li><a href="category.html">Fullwidth Banner</a></li>
                                    <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                                    <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                                    <li><a href="category.html">Left Sidebar</a></li>
                                    <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                    <li><a href="category-flex-grid.html">Product Flex Grid</a></li>
                                    <li><a href="category-horizontal-filter1.html">Horizontal Filter1</a></li>
                                    <li><a href="category-horizontal-filter2.html">Horizontal Filter2</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <a href="#" class="nolink">VARIATION 2</a>
                                <ul class="submenu">
                                    <li><a href="category-list.html">List Types</a></li>
                                    <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                                    <li><a href="category.html">3 Columns Products</a></li>
                                    <li><a href="category-4col.html">4 Columns Products</a></li>
                                    <li><a href="category-5col.html">5 Columns Products</a></li>
                                    <li><a href="category-6col.html">6 Columns Products</a></li>
                                    <li><a href="category-7col.html">7 Columns Products</a></li>
                                    <li><a href="category-8col.html">8 Columns Products</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 p-0">
                                <img src="assets/images/menu-banner.jpg" alt="Menu banner">
                            </div>
                        </div>
                    </div><
                </li>
                <li>
                    <a href="product.html" class="sf-with-ul"><i class="sicon-basket"></i>Property</a>
                    <div class="megamenu megamenu-fixed-width">
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="#" class="nolink">Variations 1</a>
                                <ul class="submenu">
                                    <li><a href="product.html">Horizontal Thumbs</a></li>
                                    <li><a href="product-full-width.html">Vertical Thumbnails</a></li>
                                    <li><a href="product.html">Inner Zoom</a></li>
                                    <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                    <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                </ul>
                            </div>// End .col-lg-4 
                            <div class="col-lg-3">
                                <a href="#" class="nolink">Variations 2</a>
                                <ul class="submenu">
                                    <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                    <li><a href="product-simple.html">Simple Product</a></li>
                                    <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                </ul>
                            </div>//End .col-lg-4
                            <div class="col-lg-3">
                                <a href="#" class="nolink">Product Layout Types</a>
                                <ul class="submenu">
                                    <li><a href="product.html">Default Layout</a></li>
                                    <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                    <li><a href="product-full-width.html">Full Width Layout</a></li>
                                    <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                    <li><a href="product-sticky-both.html">Sticky Both Side Info</a></li>
                                    <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                </ul>
                            </div>//End .col-lg-4

                            <div class="col-lg-3 p-0">
                                <img src="assets/images/menu-bg.png" alt="Menu banner" class="product-promo">
                            </div>End .col-lg-4 
                        </div>// End .row 
                    </div>// End .megamenu
                </li>
                <li>
                    <a href="#" class="sf-with-ul"><i class="sicon-envelope"></i>Mobile Phones & Tablets</a>

                    <ul>
                        <li><a href="cart.html">Shopping Cart</a></li>
                        <li><a href="#">Checkout</a>
                            <ul>
                                <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                                <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                                <li><a href="checkout-review.html">Checkout Review</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dashboard</a>
                            <ul>
                                <li><a href="dashboard.html">Dashboard</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                            </ul>
                        </li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="#">Blog</a>
                            <ul>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single.html">Blog Post</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="#" class="login-link">Login</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>Electronics</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>Home, Furniture & Appliances</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>Health & Beauty</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>Fashion</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>Sports, Arts & Outdoors</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>
                Seeking Work - CVs</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul"><i class="sicon-book-open"></i>
                Agriculture & Food</a>
                    <ul>
                        <li><a href="#">Header Types</a></li>
                        <li><a href="#">Footer Types</a></li>
                    </ul>
                </li>
            -->
                <li><a href="https://1.envato.market/DdLk5" target="_blank"><i class="sicon-star"></i>Buy Gnice!<span class="tip tip-hot">Hot</span></a></li>

            </ul>
        </nav>
    </div><!-- End .side-menu-container -->

    <div class="widget widget-banners px-5 pb-3 text-center">
        <div class="owl-carousel owl-theme">
            <div class="banner d-flex flex-column align-items-center">
                <h4 class="sale-text font1 text-uppercase m-b-3" style="font-size: 20px; padding-top:55px;">Got Something to</h4>
                <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em></h3>
                <p>Post an advert for free!</p>
            </div><!-- End .banner -->

            <div class="banner d-flex flex-column align-items-center">
                <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
                <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
            </div><!-- End .banner -->

            <div class="banner d-flex flex-column align-items-center">
                <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
                <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
            </div><!-- End .banner -->
        </div><!-- End .banner-slider -->
    </div><!-- End .widget -->

    <div class="widget widget-newsletters bg-gray text-center">
        <h3 class="widget-title text-uppercase">Subscribe Newsletter</h3>
        <p class="mb-2">Get all the latest information on Events, Sales and Offers. </p>
        <form action="#">
            <div class="form-group position-relative sicon-envolope-letter">
                <input type="email" class="form-control" name="newsletter-email" placeholder="Email address">
            </div><!-- Endd .form-group -->
            <input type="submit" class="btn btn-primary btn-md" value="Subscribe">
        </form>
    </div><!-- End .widget -->

    <div class="widget widget-posts post-date-in-media">
        <div class="owl-carousel owl-theme dots-left dots-m-0" data-owl-options="{
            'margin': 20
        }">
            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="assets/images/blog/home/post-1.jpg" alt="Post">
                    </a>
                    <div class="post-date">
                        <span class="day">29</span>
                        <span class="month">Jun</span>
                    </div><!-- End .post-date -->
                </div><!-- End .post-media -->

                <div class="post-body">
                    <h2 class="post-title m-b-2">
                        <a href="single.html">Fashion Trends</a>
                    </h2>

                    <div class="post-content">
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>

            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="assets/images/blog/home/post-2.jpg" alt="Post">
                    </a>
                    <div class="post-date">
                        <span class="day">29</span>
                        <span class="month">Jun</span>
                    </div><!-- End .post-date -->
                </div><!-- End .post-media -->

                <div class="post-body">
                    <h2 class="post-title m-b-2">
                        <a href="single.html">Fashion Trends</a>
                    </h2>

                    <div class="post-content">
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>

            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="assets/images/blog/home/post-3.jpg" alt="Post">
                    </a>
                    <div class="post-date">
                        <span class="day">29</span>
                        <span class="month">Jun</span>
                    </div><!-- End .post-date -->
                </div><!-- End .post-media -->

                <div class="post-body">
                    <h2 class="post-title m-b-2">
                        <a href="single.html">Fashion Trends</a>
                    </h2>

                    <div class="post-content">
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>
        </div><!-- End .posts-slider -->
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->