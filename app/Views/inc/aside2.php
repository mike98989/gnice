<?php?>
	<aside class="sidebar-shop col-lg-3 mobile-sidebar">
						<div class="sidebar-wrapper">
							<div class="widget"  ng-init="fetch_single_sub_category()">
								<h3 class="widget-title"  >
									<a  data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2"><img style="width: 40px!important; height: 40px!important;" src="assets/images/uploads/category/{{singleSubCats.image}}">{{ singleSubCats.parentCategory }}</a>
								</h3>

								<div class="collapse show" id="widget-body-2"  >
									<div class="widget-body">
										<ul class="cat-list" ng-init="fetch_selected_sub_category()">
											<li ng-repeat="relSubCat in relSubCats">
											 <a href="#" class="cbtn" data-id4="{{relSubCat.sub_id}}"  data-id5="{{relSubCat.parent_id}}" ><img style="width: 20px!important; height: 20px!important;" src="assets/images/uploads/category/{{relSubCat.image}}">{{relSubCat.title}}</a></li>
											
										</ul>
									</div><!-- End .widget-body -->
								</div><!-- End .collapse -->
							</div><!-- End .widget -->

							<div class="widget">
								<h3 class="widget-title">
									<a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
								</h3>

								<div class="collapse show" id="widget-body-3">
									<div class="widget-body">
										<form action="#">
											<div class="price-slider-wrapper">
												<div id="price-slider"></div><!-- End #price-slider -->
											</div><!-- End .price-slider-wrapper -->

											<div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
												<button type="submit" class="btn btn-primary">Filter</button>

												<div class="filter-price-text">
													Price:
													<span id="filter-price-range"></span>
												</div><!-- End .filter-price-text -->
											</div><!-- End .filter-price-action -->
										</form>


                                            <br>
                                            <div class="price-filter">
											
                                             
											<div class="price-filter-inner">
												 <div id="price_range" class="product_check"></div>
													<div class="price_slider_amount">
													<div class="label-input">
														<span>Range:</span> <input type="hidden" id="hidden_minimum_price" value="0">
                                             <input type="hidden" id="hidden_maximum_price" value="100000">
                                             <p id="price_show"><b>$0 - $100000</b></p>
													</div>
												</div>
											</div>
										</div>



									</div><!-- End .widget-body -->
								</div><!-- End .collapse -->
							</div><!-- End .widget -->


                        

							<div class="widget">
								<h3 class="widget-title">
									<a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Brand</a>
								</h3>

								<div class="collapse show" id="widget-body-5">
									<div class="widget-body" ng-init="fetch_all_product_brand()">
										<ul class="cat-list">
											<li  ng-repeat="allBrand in allBrands"><a ng-click="brand()" class="brands" data-brand="{{ allBrand.brand }}" href="#">{{ allBrand.brand }}</a></li>
											
										</ul>
									</div><!-- End .widget-body -->
								</div><!-- End .collapse -->
							</div><!-- End .widget -->

							<div class="widget">
								<h3 class="widget-title">
									<a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
								</h3>

								<div class="collapse show" id="widget-body-6" ng-init="fetch_all_product_color()">
									<div class="widget-body" >
										<ul class="config-swatch-list" >
											
											<li ng-repeat="allColor in allColors">
												<a ng-click="brand()" class="brands" data-brand="{{ allColor.color }}" href='' style="background-color: {{ allColor.color }};"></a>
												<span> {{ allColor.color }}</span>
											</li>
										
										</ul>
									</div><!-- End .widget-body -->
								</div><!-- End .collapse -->
							</div><!-- End .widget -->

			
							<!--
							<div class="widget widget-block">
								<h3 class="widget-title">Custom HTML Block</h3>
								<h5>This is a custom sub-title.</h5>
								<p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
							</div>
						-->
							<!-- End .widget -->
						</div><!-- End .sidebar-wrapper -->
					</aside><!-- End .col-lg-3 -->