<div id="app">
        <div id="sidebar" class='active' ng-controller="headerController">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                <img width="60px"; src="<?php echo APP_URL;?>/public/assets/images/gnice_logo.png" alt="Gnice logo"/>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu" style="padding-top:0;margin-top:0">
                        
                        <li class="sidebar-item ">
                            <a href="{{dirlocation}}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Main Home</span>
                            </a>
                        </li>
                        <li class="sidebar-item active ">
                            <a href="{{dirlocation}}dashboard/home" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{dirlocation}}dashboard/add_product" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>New Product</span>
                            </a>

                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{dirlocation}}dashboard/my_products" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>My Products</span>
                            </a>

                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{dirlocation}}dashboard/messages" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Client's Response</span>
                            </a>

                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{dirlocation}}dashboard/profile" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>My Profile</span>
                            </a>

                        </li>

                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link' ng-click="logout()">
                                <i data-feather="layout" width="20"></i>
                                <span>Logout</span>
                            </a>

                        </li>


                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>