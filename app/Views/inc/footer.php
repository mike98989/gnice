<footer class=" bg-dark" id="footer">
      <div class="footer-middle">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-sm-6 pb-5 pb-sm-0">
              <div class="widget">
                <h4 class="widget-title">About Us</h4>
                <img src="<?php echo APP_URL;?>/public/assets/images/gnice_logo.png" class="m-b-3" width="50px;">
                <p class="m-b-4 pb-1">
                It is the biggest free online classified with an advanced security system. We provide a simple hassle-free solution to sell and buy almost anything.
                </p>
                <a href="<?php echo APP_URL;?>/about" class="read-more text-white">Read more...</a>
              </div><!-- End .widget -->
            </div><!-- End .col-lg-3 -->

            <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
              <div class="widget mb-2">
                <h4 class="widget-title mb-1 pb-1">Contact Info</h4>
                <ul class="contact-info m-b-4">
                  <li>
                    <span class="contact-info-label">Phone:</span> 0706000000
                  </li>
                  <li>
                    <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">ads@gnice.com.ng</a>
                  </li>
                  <li>
                   <a href="mailto:gnice.market@gmail.com">gnice.market@gmail.com</a>
                  </li>
                  
                  
                </ul>
                <div class="social-icons">
                  <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                  <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                  <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                </div><!-- End .social-icons -->
              </div><!-- End .widget -->
            </div><!-- End .col-lg-3 -->

            <div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
              <div class="widget">
                <h4 class="widget-title pb-1">Quick Links</h4>

                <ul class="links">
                  <li><a href="about.html">Help & FAQs</a></li>
                  <li><a href="my-account.html">My Account</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                  <li><a href="{{dirlocation}}privacypolicy">Privacy</a></li>
                </ul>
              </div><!-- End .widget -->
            </div><!-- End .col-lg-3 -->

            <div class="col-lg-2 col-sm-6 pb-5 pb-sm-0">
              <img src="<?php echo APP_URL;?>/public/assets/images/ios.svg"/>
              <br>
              <img src="<?php echo APP_URL;?>/public/assets/images/android.svg"/>
            </div><!-- End .col-lg-3 -->
          </div><!-- End .row -->
        </div><!-- End .container -->
      </div><!-- End .footer-middle -->

      <div class="container">
        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
          <p class="footer-copyright py-3 pr-4 mb-0">© Gnice Market Place Ltd. 2021. All Rights Reserved</p>
        </div>
      </div><!-- End .container -->
    </footer><!-- End .footer -->
  </div><!-- End .page-wrapper -->


    <a id="scroll-top" href="#top" title="Top" role="button"
      ><i class="icon-angle-up"></i
    ></a>

<!-- mobile menu -->

<style>
  @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
  .nav{
	position : fixed;
	bottom: 0;
	width: 100%;
	height: 55px;
	box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
	background-color: #ffffff;
	display:flex;
	overflow-x: auto;
}

.nav--link{
	display: flex; 
	flex-direction: column;
	align-items: center;
	justify-content: center;
	flex-grow: 1;
	min-width: 50px;
	overflow: hidden;
	white-space: nowrap;
	font-family: sans-serif;
	font-size: 13px;
	color: #444444;
	text-decoration : none;
	-webkit-tap-highlight-color: transparent;
	transition: background-color 0.1s ease-in-out;
}

.nav--link:hover{
	background-color: #eeeeee;
}

.nav--link--active{
	color: skyblue;
}

.nav--icon{
	font-size:18px;
}
.hide{
  display: none;
}
</style>
<div id="mobile_menu" ng-controller="homeController">

<nav class="nav">
	<a href="<?php echo APP_URL;?>/home" class="nav--link" ng-class="{'nav--link--active': menu_active == '1'}" ng-click="menu_active='1';">
		<i class="material-icons nav--icon">home</i>
		<span class="nav--text">Home</span>
	</a>
	<a href="<?php echo APP_URL;?>/dashboard/profile" class="nav--link">
		<i class="material-icons nav--icon">person</i>
		<span class="nav--text">Profile</span>
	</a>
	<!-- <a href="#" class="nav--link">
		<i class="material-icons nav--icon">chat</i>
		<span class="nav--text">Messages</span>
	</a> -->
	<a href="{{dirlocation}}privacypolicy" class="nav--link" ng-class="{'nav--link--active': menu_active == '1'}" ng-click="menu_active='1';">
		<i class="material-icons nav--icon">bookmark_border</i>
		<span class="nav--text">Privacy</span>
	</a>
	<a href="<?php echo APP_URL;?>/dashboard/add_product" class="nav--link">
		<i class="material-icons nav--icon">add_box</i>
		<span class="nav--text">Sell</span>
	</a>
</nav>
</div>

<script>
 
    (function(){
      
      let check = false;
      const menu = document.querySelector('#mobile_menu');
      const footer = document.querySelector('#footer');
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  // return check;
  // alert(check);

  // console.log(check);
  // alert(check);
  if(check){
    menu.style.display = "block";
    footer.style.display = "none";
  }else{
    menu.style.display = "none";
    footer.style.display = "block";
  }
})();

</script>
<!-- end mobile menu -->

 