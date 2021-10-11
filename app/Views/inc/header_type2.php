


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo_6/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Jun 2021 16:55:21 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Gnice Market Place</title>

	<meta name="keywords" content="<?php echo APP_KEYWORD;?>" />
    <meta name="description" content="<?php echo APP_DESCRIPTION;?>" />
	
		
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo APP_URL;?>/assets/images/gnice_logo.png">
	
	
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700','Poppins:300,400,500,600,700,800', 'Playfair+Display:900' ] }
		};
		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>

	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/jquery-ui.css">
	<style type="text/css">
		.jumbotron{
  
  
    background: 
linear-gradient(
  rgba(0, 0, 250, 0.25), 
  rgba(125, 250, 250, 0.45)
),

background-position: center;
background-repeat: no-repeat;
background-attachment: fixed;
color:white !important;
height:270px;
width: 100%;
background-size: cover;
}

.page-scroll{
  height:5000px;
}

.btn-outline-danger{
  color:white;
  border-color:white;
  border-radius:0px;
  font-weight:100;
  margin-top:20px;
}
.lead{
  font-family:raleway;
  font-weight:100;
  margin-top:-10px;
}
	</style>
	

	<!-- Main CSS File -->
	<link rel="stylesheet" href="assets/css/style.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>/assets/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body ng-app="gnice">

<div class="page-wrapper">
	<!--
		<div class="top-notice text-white bg-dark"  ng-controller="homeController">
			<div class="container text-center" ng-init="getAllBanner()">
				<h5 class="d-inline-block mb-0">
				{{ banners.title }}</h5>
				
			</div> End .container 
		</div>End .top-notice -->

		<header class="header" ng-controller="homeController">
			<div class="header-top bg-primary text-uppercase">
				<div class="container">
					<div class="header-left">
						<button class="mobile-menu-toggler mr-2" type="button">
							<i class="icon-menu"></i>
						</button>
				
						<a href="Home" class="logo">
							<img width="50px"; height="50px" src="assets/images/gnicelogo.jpeg" alt="Porto Logo">
						</a>
                          <!--
						<div class="header-dropdown ml-4">
						<p class="top-message mb-0 mr-lg-5 pr-3 d-none d-sm-block">Find everything in 
						<a href="#" style="background: black; padding: 6px;">&nbsp; &nbsp;<i class="material-icons" style="font-size:16px">edit_location</i>All Nigeria</a></p>
						</div>
						End .header-dropown -->
					</div><!-- End .header-left -->

					<div class="header-right header-dropdowns ml-0 ml-sm-auto">
											<div class=" d-lg-flex align-items-center" ng-controller="loginController">

                             <?php
                             session_start();
                            if (!isset($_SESSION['user_name'])) {
                            	?>
                                	<a href="Login">Sign In</a>
							<a href="Signup"> &nbsp; | Registration &nbsp; &nbsp;</a>
							<button type="button" class="btn btn-primary btn-sm" style="border-radius: 25px;"><a href="Login">SELL</a></button>
                            	<?php
                            }  else {
                            ?>
                            <a href="Dashboard">Dashboard</a>
                         <button type="button" class="btn btn-primary btn-sm" style="border-radius: 25px;"><a href="Login">SELL</a></button>
                   <?php
                     }
                      ?>

						</div>

						
					</div><!-- End .header-right -->

				</div><!-- End .container -->

			</div><!-- End .header-top -->
            <!--
			<div class="header-middle text-dark">
				<div class="container">
					<div class="header-left col-lg-2 w-auto pl-0">
						<?php
                          if (isset($_SESSION['user_name'])) {
						?>
						<button class="mobile-menu-toggler mr-2" type="button">
							<i class="icon-menu"></i>
						</button>
					<?php }?>
						<a href="Home" class="logo">
							<img src="assets/images/gnicelogo.jpeg" alt="Porto Logo">
						</a>
					</div>End .header-left 

					<div class="header-right w-lg-max pl-2"  ng-controller="homeController">
						<div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4"  >
							<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
							
								<div class="header-search-wrapper">
									
									<div class="select-custom">
										 <select id="cat" name="cat"  ng-init="fetch_all_categories_and_sub_categories()" >
                        <option   value="">All Categories</option>
                        <optgroup  ng-repeat="catSub in catSubs" label=" - {{catSub.title}}">
                          <option  ng-repeat="sub in catSub.subcategory" value="{{ sub.sub_id }},{{ sub.parent_id }}">{{ sub.title }}</option>
                        </optgroup>
                       
                      </select>
									</div> End .select-custom 
									<button class="btn p-0 icon-search-3"  ng-click="searchCat()"></button>
								</div>End .header-search-wrapper 
							
						</div>End .header-search 


					

				
						End .header-contact

					</div>End .header-rig
				</div>
			</div> 
		-->
		</header><!-- End .header -->    