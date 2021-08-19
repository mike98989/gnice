<style>

div.polaroid {

  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.19);
}

</style>

<div class="sidebar-overlay"></div>

<aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
    <div class="side-menu-wrapper text-uppercase mb-2 d-lg-block d-none polaroid" style="background-color: white;">
        <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>

        <nav class="side-nav">                           
            <ul class="menu menu-vertical sf-arrows" ng-init="fetch_all_categories_and_sub_categories()">
                <li ng-repeat="catSub in catSubs">
                    <a href="#" class="sf-with-ul cabtn" data-idc="{{catSub.id}}"><img style="width: 40px!important; height: 40px!important;" src="assets/images/uploads/category/{{catSub.image}}">{{catSub.title}}</a>
                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="nolink">{{catSub.title}}</a>
                                <ul class="submenu">
                                    <li ng-repeat="sub in catSub.subcategory ">
                                        <a href="#" class="cbtn" data-id4="{{sub.sub_id}}" data-id5="{{sub.parent_id}}">
                                            <img style="width: 40px!important; height: 40px!important;" src="assets/images/uploads/category/{{sub.image}}">{{ sub.title }} </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 p-0">
                                <img src="assets/images/menu-banner.jpg" alt="Menu banner">
                            </div>
                        </div>
                    </div><!-- End .megamenu -->
                </li>               
                <li><a href="https://1.envato.market/DdLk5" target="_blank"><i class="sicon-star"></i>Buy Gnice!<span class="tip tip-hot">Hot</span></a></li>
            </ul>
        </nav>
    </div><!-- End .side-menu-container -->
    <div class="widget widget-posts post-date-in-media">
        <div class="owl-carousel owl-theme dots-left dots-m-0" data-owl-options="{
            'margin': 20
        }">

</aside><!-- End .col-lg-3 -->