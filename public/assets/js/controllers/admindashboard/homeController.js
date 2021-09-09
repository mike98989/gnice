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
      alert("home");
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
          console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);

          $(".loader").hide();
          console.table(JSON.stringify(msg));
          if (msg.status == "1") {
            $scope.statistics = msg.data;
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
          console.table(JSON.stringify(msg));
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

    $scope.add_subcategory = function () {
      $(".loader").show();

      var formData = new FormData($("#add_subcategory")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/add_subcategory",
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
          //  alert(answer);
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

    $scope.AddHero = function () {
      $(".loader").show();
      var formData = new FormData($("#AddHero")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/AddHero",
        type: "POST",
        transformRequest: angular.identity,
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        headers: { "gnice-authenticate": "gnice-web" },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        transformRequest: angular.identity,
        enctype: "multipart/form-data",

        crossDomain: true,
        processData: false,
        success: function (answer) {
          //alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          }
        },
      });
    };

    //alert($scope.dirlocation);
    $scope.fetch_all_category = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_category",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result) {
          //alert(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          console.log(msg);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.categories = msg.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.deleteCategory = function () {
      $("body").delegate(".dbtn", "click", function (event) {
        event.preventDefault();
        $localStorage.delete = $(this).attr("data-did");
        $.ajax({
          url:
            $scope.dirlocation +
            "api/deleteCategory?id=" +
            $localStorage.delete,
          type: "GET",
          //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
          async: true,
          cache: false,
          contentType: false,
          headers: { "gnice-authenticate": "gnice-web" },
          processData: false,
          success: function (result3) {
            //alert(result3);
            var response3 = JSON.stringify(result3);
            var parsed3 = JSON.parse(response3);
            var msg3 = angular.fromJson(response3);
            //alert(msg3);
            console.log(msg3);
            $(".loader").hide();
            if (msg3.status == "1") {
              alert(msg3.message);
              window.location.reload();
            } else {
              $(".loader").hide();
              $(".result").html(msg3.message);
              $(".result").show();
              alert(msg3.message);
              //alert(msg.msg);
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
            }
          },
        });
      });
    };

    $scope.updateCategory = function () {
      $(".loader").show();
      $(".result").hide();
      var formData = new FormData($("#updateCategory")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/updateCategory",
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
          alert(msg);

          $(".loader").hide();
          if (msg.status == "1") {
            alert(msg.message);
            $("#update").modal("show");
          } else {
            alert(msg.message);
            $("#update").modal("show");
            //alert(msg.msg);
            //$('.signup_loader').hide();
            //$('.alert').html(answer);
          }
        },
      });
    };

    $scope.fetch_all_sub_category = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_sub_category",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result1) {
          //alert(result1);
          var response1 = JSON.stringify(result1);
          var parsed1 = JSON.parse(response1);
          var msg1 = angular.fromJson(response1);

          console.log(msg1);
          $(".loader").hide();
          if (msg1.status == "1") {
            $scope.subcategories = msg1.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.updatesubCategory = function () {
      $(".loader").show();
      $(".result").hide();
      var formData = new FormData($("#updatesubCategory")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/updatesubCategory",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        headers: { "gnice-authenticate": "gnice-web" },
        crossDomain: true,
        processData: false,
        success: function (answer) {
          // alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          //alert(msg);
          console.log(msg);
          $(".loader").hide();
          if (msg.status == "1") {
            alert(msg.message);
            $("#update").modal("show");
          } else {
            alert(msg.message);
            $("#update").modal("show");
            //alert(msg.msg);
            //$('.signup_loader').hide();
            //$('.alert').html(answer);
          }
        },
      });
    };

    $scope.deletesubCategory = function () {
      $("body").delegate(".dbtn", "click", function (event) {
        event.preventDefault();
        $localStorage.deletes = $(this).attr("data-dids");
        alert($localStorage.deletes);
        $.ajax({
          url:
            $scope.dirlocation +
            "api/deletesubCategory?id=" +
            $localStorage.deletes,
          type: "GET",
          //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
          async: true,
          cache: false,
          contentType: false,
          headers: { "gnice-authenticate": "gnice-web" },
          processData: false,
          success: function (result3) {
            //alert(result3);
            var response3 = JSON.stringify(result3);
            var parsed3 = JSON.parse(response3);
            var msg3 = angular.fromJson(response3);
            //alert(msg3);
            console.log(msg3);
            $(".loader").hide();
            if (msg3.status == "1") {
              alert(msg3.message);
              window.location.reload();
            } else {
              $(".loader").hide();
              $(".result").html(msg3.message);
              $(".result").show();
              alert(msg3.message);
              //alert(msg.msg);
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
            }
          },
        });
      });
    };
    //* Ends
  },
]);
