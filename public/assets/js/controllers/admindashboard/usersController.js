///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("usersController", [
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
    $scope.pageSize = 5;
    $scope.admin_data = $localStorage.user_data;
    $scope.admin_token = $localStorage.user_token;
    setTimeout(function () {
      $scope.$apply();
    }, 0);

    $scope.get_all_users = function () {
      $(".loader").show();
      $(".result").hide();
      // alert("got here");
      // alert(JSON.stringify($scope.admin_data.email));
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_users",
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
          // alert(JSON.stringify(result));
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          //alert(JSON.stringify(msg.data));
          if (msg.status == "1") {
            $scope.all_users = msg.data;
            $scope.$apply();
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.enable_or_disable = function (code, user, index) {
      var conf = confirm(
        "DO YOU WANT DISABLE/ENABLE THIS USER '" + user.fullname + "'?"
      );
      // alert(index);
      if (conf) {
        $(".loader2_" + user.fullname).show();
        var formData = new FormData();
        formData.append("status", code);
        formData.append("seller_id", user.seller_id);
        $.ajax({
          url: $scope.dirlocation + "adminapi/disable_enable_account",
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
            $(".loader2_" + user.id).hide();
            if (msg.status == "1") {
              // alert(index, code);
              // all_users[index].status = code;
              user.status = code;
              $scope.$apply();
              $(".result").show();
            }
          },
        });
      }
    };
    //! TODO: save and retrieved data from localStorage
    $scope.localStorage_get = function (key) {
      $scope[key] = $localStorage[key];
      alert($localStorage[key]);
      // $scope.$apply();
    };

    $scope.localStorage_save = function (key, value, url) {
      $localStorage[key] = value;
      // $scope[key] = $localStorage[key];
      alert(JSON.stringify(value));
      // return;
      if (url != "") {
        $scope.go_to_url(url);
      }
    };
    $scope.go_to_url = function (url) {
      //alert($scope.dirlocation+'admindashboard/'+url);
      window.location.href = $scope.dirlocation + "admindashboard/" + url;
    };

    //! important functions above

    //* more data into modal window
    $scope.append_modal_user_info = function (value) {
      $scope.userInfo = value;
      console.log(JSON.stringify($scope.userInfo));
      $scope.fetch_all_seller_products();
    };

    //! get all listings of a seller
    $scope.fetch_all_product_of_seller = function (seller_id) {
      $.ajax({
        url:
          $scope.dirlocation +
          "adminapi/fetch_all_product_of_seller?seller_id=" +
          seller_id,
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          console.log(msg);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.all_user_ads = msg.data;
            $scope.rowCount = msg.rowCounts;
            $scope.$apply();
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
  },
]);
