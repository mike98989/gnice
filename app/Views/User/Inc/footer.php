<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2020 &copy; Voler</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                    href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
        </div>
    </div>
</footer>
</div>


<script src="<?php echo APP_URL;?>/public/assets/js/jquery.min.js"></script>
<script src="<?php echo APP_URL;?>/public/assets/js/jquery-ui.min.js"></script>
   
<script src="<?php echo APP_URL; ?>/public/user-assets/js/feather-icons/feather.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/user-assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/user-assets/js/app.js"></script>


<script src="<?php echo APP_URL; ?>/public/user-assets/js/main.js"></script>

 <!-- Plugins JS File -->

   <!-- <script src="<?php echo APP_URL;?>/public/assets/custom-js/signup.js"></script> -->
    <script src="<?php echo APP_URL; ?>/public/assets/js/angular/angular.js"></script>
    <script src="<?php echo APP_URL; ?>/public/assets/js/angular/angular-route.js"></script>
    <script src="<?php echo APP_URL; ?>/public/assets/js/dirPagination.js"></script>
    <script src="<?php echo APP_URL; ?>/public/assets/js/angular/angular-sanitize.js"></script>
    <script src="<?php echo APP_URL; ?>/public/assets/js/angular/angular-cookies.js"></script>
    <script src="<?php echo APP_URL; ?>/public/assets/js/angular/ngStorage.min.js"></script>
    <!----MODULE-->
    <script src="<?php echo APP_URL.'/public/assets/js/controllers/module.js';?>"></script>

  <?php
  if (isset($js)) {
    foreach ($js as $jsfile) {
      echo "<script src=".APP_URL."/public/assets/js/".$jsfile."></script>";
    }
  }
//////EXTERNAL JAVASCRIPT
  if (isset($external_js)) {
    foreach ($external_js as $external_jsfile) {
      echo "<script type='text/javascript' src=".$external_jsfile."></script>";
    }
  }
?>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/headerController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/productController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/homeController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/messageController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/profileController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/web/packageController.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/webapp.js';?>"></script>
<script src="<?php echo APP_URL.'/public/assets/js/controllers/directives.js';?>"></script>

</body>

</html>