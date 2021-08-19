
	<aside class="sidebar col-lg-3" ng-controller="homeController">
						<div class="widget widget-dashboard">
							<h3 class="widget-title">My Account</h3>

							<ul class="list" ng-init="fetch_all_sub_page()">
								<li class="active"><a href="Dashboard">Account Dashboard</a></li>
								<li ng-repeat="subpage in subpages"><a href="{{subpage.address}}">{{subpage.title}}</a></li>
								
								
								
							</ul>
						</div><!-- End .widget -->
					</aside><!-- End .col-lg-3 -->