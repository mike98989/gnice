///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("adminController", [
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
    // $scope.admin_privilege = $localStorage.user_data.privilege;
    $scope.normal = 1;
    $scope.advance = 2;
    $scope.ultra = 3;

    setTimeout(function () {
      $scope.$apply();
    }, 0);

    $scope.get_admin_privilege = function () {
      $scope.admin_data;
    };
    $scope.get_all_admins = function () {
      alert("got here");
      $(".loader").show();
      $(".result").hide();
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_admins",
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
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.all_admins = msg.data;
            console.log(msg.data);
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
  },
]);
