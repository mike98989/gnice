

    <!-- Plugins JS File -->
    <script src="<?php echo APP_URL;?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/jquery.bootstrap.wizard.js"></script>
    <script src="<?php echo APP_URL;?>/assets/js/gsdk-bootstrap-wizard.js"></script>
     <script src="<?php echo APP_URL;?>/assets/js/jquery.validate.min.js"></script>
     
    <script src="<?php echo APP_URL;?>/assets/js/plugins.min.js"></script>

    <!-- Main JS File -->
    <script src="<?php echo APP_URL;?>/assets/js/main.min.js"></script>
    <script src="<?php echo APP_URL;?>/assets/custom-js/signup.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-route.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/dirPagination.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-sanitize.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/angular-cookies.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/angular/ngStorage.min.js"></script>
    <!----MODULE-->
    <script src="<?php echo APP_URL.'/assets/js/controllers/module.js';?>"></script>

  <?php
  if (isset($js)) {
    foreach ($js as $jsfile) {
      echo "<script src=".APP_URL."/assets/js/".$jsfile."></script>";
    }
  }
//////EXTERNAL JAVASCRIPT
  if (isset($external_js)) {
    foreach ($external_js as $external_jsfile) {
      echo "<script type='text/javascript' src=".$external_jsfile."></script>";
    }
  }
?>
<script src="<?php echo APP_URL.'/assets//js/controllers/directives.js';?>"></script>

  </body>

  <!-- Mirrored from portotheme.com/html/porto_ecommerce/demo_6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Jun 2021 16:56:10 GMT -->
</html>