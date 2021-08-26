<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}admindashboard">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item" style="cursor:pointer">
                <a class="nav-link" href="{{dirlocation}}admindashboard/categories">
                    <span class="menu-title">Categories</span>
                    <i class="menu-arrow" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Categories</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Sub
                                Categories</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}admindashboard/listings">
                    <span class="menu-title">Listings/Ads</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}admindashboard/users">
                    <span class="menu-title">All Users</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}admindashboard/account_types">
                    <span class="menu-title">Seller Account Types</span>
                    <i class="mdi mdi-chart-bar menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}admindashboard/banners">
                    <span class="menu-title">Banners</span>
                    <i class="mdi mdi-table-large menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{dirlocation}}logout">
                    <span class="menu-title">Logout</span>
                </a>
            </li>



        </ul>
    </nav>
    <!-- partial -->