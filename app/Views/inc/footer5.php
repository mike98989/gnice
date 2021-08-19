 <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!--
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
           
          </div>
        </footer>
    -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  </div>
  <!-- container-scroller -->
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?php echo APP_URL; ?>/public/admin-assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo APP_URL; ?>/public/admin-assets/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo APP_URL; ?>/public/admin-assets/js/off-canvas.js"></script>
<script src="<?php echo APP_URL; ?>/public/admin-assets/js/hoverable-collapse.js"></script>
<script src="<?php echo APP_URL; ?>/public/admin-assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?php echo APP_URL; ?>/public/admin-assets/js/dashboard.js"></script>
<script src="<?php echo APP_URL; ?>/public/admin-assets/js/todolist.js"></script>
<!-- End custom js for this page -->

 <!-- Plugins JS File -->
    <script src="<?php echo APP_URL;?>/public/assets/js/jquery.min.js"></script>
     <script src="<?php echo APP_URL;?>/public/assets/js/jquery-ui.min.js"></script>
   
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
<script src="<?php echo APP_URL.'/public/assets/js/controllers/directives.js';?>"></script>
</body>

</html>