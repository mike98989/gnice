///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("listingController", [
  "$scope",
  "$sce",
  "$http",
  "infogathering",
  "$routeParams",
  "$localStorage",
  "$sessionStorage",
  function (
    $scope,
    $sce,
    $http,
    datagrab,
    $routeParams,
    $localStorage,
    $sessionStorage
  ) {
    $scope.fieldcounter = 1;
    //$('.loader').show();
    var url = window.location.href;
    if (url.indexOf("#") > 1) {
      var page = window.location.href.split("#");
      var pager = page[1].split("=").pop();

      if (
        pager == "" ||
        pager == "undefined" ||
        pager == null ||
        pager == "0"
      ) {
        pager = "1";
      }
    } else {
      pager = "1";
    }

    $scope.dirlocation = datagrab.completeUrlLocation;
    $scope.currentPage = pager;
    $scope.pageSize = 10;
    $scope.admin_data = $localStorage.user_data;
    $scope.admin_token = $localStorage.user_token;
    setTimeout(function () {
      $scope.$apply();
    }, 0);

    $scope.get_all_products = function () {
      $(".loader").show();
      $(".result").hide();
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_products",
        type: "GET",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate":
            $scope.admin_token + ":email:" + $scope.admin_data.email,
        },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          // alert(JSON.stringify(msg.data));
          if (msg.status == "1") {
            $scope.all_listings = msg.data;
            $scope.notification = msg.msg;
            $scope.status == msg.status;
            $scope.$apply();
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.enable_or_disable_listing = function (code, listing, index) {
      // alert(index);
      // return;
      var conf = confirm(
        "DO YOU WANT DISABLE/ENABLE THIS USER '" + listing.name + "'?"
      );
      if (conf) {
        $(".loader2_" + listing.namr).show();
        var formData = new FormData();
        formData.append("status", code);
        formData.append("product_code", listing.product_code);
        $.ajax({
          url: $scope.dirlocation + "adminapi/disable_enable_ads",
          data: formData,
          type: "POST",
          async: true,
          cache: false,
          contentType: false,
          headers: { "gnice-authenticate": $scope.admin_token },
          processData: false,
          success: function (result) {
            var response = JSON.stringify(result);
            var parsed = JSON.parse(response);
            var msg = angular.fromJson(parsed);
            $(".loader2_" + listing.id).hide();
            if (msg.status == "1") {
              // alert(JSON.stringify($scope.all_listings[index]));
              listing.status = code;
              $scope.$apply();
              $(".result").show();
            }
          },
        });
      }
    };
  },
]);
