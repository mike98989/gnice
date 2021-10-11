<div class="sidebar-overlay"></div>
<div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
<aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar" ng-init="fetch_all_categories_and_sub_categories()">
    <div class="side-menu-wrapper text-uppercase mb-2 d-lg-block d-none" style="border-top:none;background-color: #fff;">
        <h2 class="side-menu-title bg-gray ls-n-25" style="padding-top:20px;margin-top:0">Browse Categories</h2>
        <nav class="side-nav">    
            <ul class="menu menu-vertical sf-arrows">
                <li ng-repeat="catSub in catSubs">
                    <a href="{{dirlocation}}category?id={{catSub.id}}&cat={{catSub.title}}" style="font-weight:normal;"><img style="width: 20px!important; height: 20px!important;float:left;margin-right:7px;margin-top:0" src="{{dirlocation}}public/assets/images/uploads/category/{{catSub.image}}">{{catSub.title}}</a>
                                <ul class="submenu">
                                    <li ng-repeat="sub in catSub.subcategory ">
                                        <a href="{{dirlocation}}category/sub_category?id={{sub.sub_id}}&cat={{catSub.title}}&sub={{sub.title}}">
                                        <img ng-show="sub.image!=''" style="display:none;width: 30px!important; height: 30px!important;" src="{{dirlocation}}public/assets/images/uploads/category/{{sub.image}}">{{ sub.title }} </a>
                                    </li>
                                </ul>
                </li>
               
                <li><a href="#" target="_blank"><i class="sicon-star"></i>Buy Gnice!<span class="tip tip-hot">Hot</span></a></li>

            </ul>
        </nav>
    </div><!-- End .side-menu-container -->

    <div class="widget widget-banners px-5 pb-3 text-center" style="background-color: #fff;">
        <div class="owl-carousel owl-theme">
            <div class="banner d-flex flex-column align-items-center">
                <h4 class="sale-text font1 text-uppercase m-b-3" style="font-size: 20px; padding-top:55px;">Got Something to</h4>
                <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sell</em></h3>
                <p>Post an advert for free!</p>
            </div><!-- End .banner -->

            <div class="banner d-flex flex-column align-items-center">
                <h3
                    class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase">
                    <em class="pt-3 ls-0">Sale</em>Many Item
                </h3>
                <h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
                <p>Get an awoof discounted rate this EMBER Month.</p>
                <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
            </div><!-- End .banner -->

            <div class="banner d-flex flex-column align-items-center">
                <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
                <h4 class="sale-text font1 text-uppercase m-b-3">1<sup>000000</sup></h4>
                <p>Over 1 Million New Content on Gnice Market Place.</p>
                <a href="#" class="btn btn-dark btn-md font1">View Sale</a>
            </div><!-- End .banner -->
        </div><!-- End .banner-slider -->
    </div><!-- End .widget -->

    <div class="widget widget-newsletters bg-gray text-center">
        <h3 class="widget-title text-uppercase">Subscribe Newsletter</h3>
        <p class="mb-2">Get all the latest information on Events, Listings and Offers. </p>
        <form ng-submit="submit_newsletter()" id="newsletter_form">
            <div class="alert alert-info result" style="display:none"></div>
            <div class="form-group position-relative sicon-envolope-letter">
                <input type="email" class="form-control" name="email" placeholder="Email address">
            </div><!-- Endd .form-group -->
            <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
            <button type="submit" class="btn bg-primary text-white"><img src="{{dirlocation}}public/assets/images/spinner2.gif" class="loader" style="float:left;width:15px;margin-right:5px;display:none"> Subscribe</button>
        </form>
    </div><!-- End .widget -->

    <div class="widget widget-posts post-date-in-media" style="display:none">
        <div class="owl-carousel owl-theme dots-left dots-m-0" data-owl-options="{
            'margin': 20
        }">
            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="{{dirlocation}}public/assets/images/blog/home/post-1.jpg" alt="Post">
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
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent
                            per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>

            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="{{dirlocation}}public/assets/images/blog/home/post-2.jpg" alt="Post">
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
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent
                            per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>

            <article class="post">
                <div class="post-media">
                    <a href="single.html">
                        <img src="{{dirlocation}}public/assets/images/blog/home/post-3.jpg" alt="Post">
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
                        <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent
                            per conubia nostra, per incep tos himens.</p>

                        <a href="single.html" class="read-more">read more <i class="icon-right-open"></i></a>
                    </div><!-- End .post-content -->
                </div><!-- End .post-body -->
            </article>
        </div><!-- End .posts-slider -->
    </div><!-- End .widget -->


    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu mb-3">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li ng-repeat="catSub in catSubs">
                    <a href="{{dirlocation}}category?id={{catSub.id}}&cat={{catSub.title}}">{{catSub.title}}</a>
                                <ul>
                                    <li ng-repeat="sub in catSub.subcategory ">
                                        <a href="{{dirlocation}}category/sub_category?id={{sub.sub_id}}&cat={{catSub.title}}&sub={{sub.title}}">
                                        {{ sub.title }} </a>
                                    </li>
                                </ul>
                    </li>
               
                   
                    <!-- <li><a href="blog.html">Blog</a>
                        <ul>
                            <li><a href="{{dirlocation}}contact">Blog Post</a></li>
                        </ul>
                    </li> -->
                   
                    <!-- <li><a href="#">Special Offer!<span class="tip tip-hot">Hot!</span></a></li>
                    <li><a href="https://1.envato.market/DdLk5" target="_blank">Buy Porto!</a></li> -->
                </ul>

                <ul class="mobile-menu">
                    <li><a href="{{dirlocation}}#">Blog</a></li>
                    <li><a href="{{dirlocation}}contact">Contact Us</a></li>
                    <li><a href="{{dirlocation}}about">About</a></li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->
</aside><!-- End .col-lg-3 -->
