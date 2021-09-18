///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("homeController", [
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

    $scope.home_stats = function () {
      $(".loader").show(5000);
      $(".result").hide();
      $.ajax({
        url: $scope.dirlocation + "adminapi/home_statistics",
        type: "GET",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate": $scope.admin_token,
        },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);

          $(".loader").hide();
          // console.log(msg);
          if (msg.status == "1") {
            $scope.statistics = msg.data;
            $scope.notification = msg.msg;
            $scope.status == msg.status;
            $scope.$apply();
            $(".result").show();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show();
            setTimeout(() => {
              $(".result").removeClass("alert alert-info");
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };

    //! Starts

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
          if (msg.status == "1") {
            $scope.all_listings = msg.data;
            $scope.notification = msg.msg;
            $scope.status == msg.status;
            $scope.$apply();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show();
            setTimeout(() => {
              $(".result").removeClass("alert alert-info");
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };
    $("body").delegate(".cbtn", "click", function (event) {
      event.preventDefault();
      var cid1 = $(this).attr("data-cid1");
      var cid2 = $(this).attr("data-cid2");
      $("#update").modal("show");
      $("#id").val(cid1);
      $("#titles").val(cid2);
    });

    $("body").delegate(".cbtn", "click", function (event) {
      event.preventDefault();
      var cids1 = $(this).attr("data-cids1");
      var cids2 = $(this).attr("data-cids2");
      var cids3 = $(this).attr("data-cids3");
      $("#update").modal("show");
      $("#id").val(cids1);
      $("#titles").val(cids3);
      $("#parent_id").val(cids2);
    });

    $scope.AddBanner = function () {
      $(".loader").show();
      $(".result").hide();
      var formData = new FormData($("#AddBanner")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/AddBanner",
        type: "POST",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        headers: { "gnice-authenticate": "gnice-web" },
        crossDomain: true,
        processData: false,
        success: function (answer) {
          //alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          //alert(msg);
          console.log(msg);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            alert(msg.message);
            $(".result").show();

            //$('.signup_loader').hide();
            //$('.alert').html(answer);
          }
        },
      });
    };

    $scope.add_category = function () {
      $(".loader").show();

      var formData = new FormData($("#add_category")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/add_category",
        type: "POST",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        headers: { "gnice-authenticate": "gnice-web" },
        crossDomain: true,
        processData: false,
        success: function (answer) {
          //alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          //alert(msg);
          console.log(msg);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            alert(msg.message);
            $(".result").show();

            //$('.signup_loader').hide();
            //$('.alert').html(answer);
          }
        },
      });
    };
  },
]);
