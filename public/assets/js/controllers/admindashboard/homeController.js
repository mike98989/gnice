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
    // $scope.loader_control = function(e){
    //   $(e).hide(1000);
    // };
    $scope.home_stats = function () {
      $(".result").hide();
      $('#home_loader').show();
      alert('got here mobile');
      alert($scope.admin_token);
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


          $('#home_loader').hide(500);

          if (msg.status == "1") {
    
            $scope.statistics = msg.data;
            $scope.notification = msg.msg;
            $scope.status == msg.status;
            $scope.$apply();
          } else {
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);
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

      $('#listing_loader').show(100);
      alert('got here get 2');
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
           console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);

          $('#listing_loader').hide(500);
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
    // $("body").delegate(".cbtn", "click", function (event) {
    //   event.preventDefault();
    //   var cids1 = $(this).attr("data-cids1");
    //   var cids2 = $(this).attr("data-cids2");
    //   var cids3 = $(this).attr("data-cids3");
    //   $("#update").modal("show");
    //   $("#id").val(cids1);
    //   $("#titles").val(cids3);
    //   $("#parent_id").val(cids2);
    // });



  },
]);
