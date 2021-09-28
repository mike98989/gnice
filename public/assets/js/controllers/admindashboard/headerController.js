///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("headerController", [
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
    //$('.loader').show();
    var url = window.location.href;
    // if(url.indexOf('home')>1){
    //   $scope.menu_active = '1';
    // }
    // else if((url.indexOf('profile')>1)||(url.indexOf('staff')>1)){
    // $scope.menu_active = '2';
    // }
    // else if(url.indexOf('meetings')>1){
    //   $scope.menu_active = '3';
    // }
    // else if(url.indexOf('daily_state')>1){
    //   $scope.menu_active = '4';
    // }
    // else if(url.indexOf('admins')>1){
    //   $scope.menu_active = '5';
    // }
    // else if(url.indexOf('qualification')>1){
    //   $scope.menu_active = '6';
    // }
    // else if(url.indexOf('complaints')>1){
    //   $scope.menu_active = '7';
    // }

    // else{
    //   $scope.menu_active = '1';
    // }

    $scope.dirlocation = datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    $scope.user_data = datagrab.user_data;
    $scope.user_token = datagrab.user_token;
    // $scope.admin_token = user_token;

    //! more data into modal window
    $scope.append_modal_info = function (value) {
      $scope.info = value;
      // console.log(JSON.stringify($scope.info));
      //$scope.get_all_users();
    };
    $scope.toggle_form = function (id, index) {
      $(".form_inverse_" + id).toggle(500);
      $(".form_" + id).toggle(500);
    };
    $scope.toggle_password_form = function () {
      $(".password_form_inverse").toggle(500);
      $(".password_form").toggle(500);
    };

    //* start
    $scope.change_admin_password = function () {
      $(".header_loader").show();

      var formData = new FormData($("#change_password")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminauth/change_admin_password",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.user_token },
        processData: false,
        success: function (answer) {
          
         
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".header_loader").hide(500);
          if (msg.status == "1") {
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info text-center");
            // $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
              $("#create_new_admin_form")[0].reset();
            }, 4000);
            $scope.toggle_password_form();
           
            $scope.$apply();
          } else {
           
            $(".result").addClass("alert alert-info text-center");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info text-center");
            }, 3000);
          }
        },
      });
    };
    //* end
  },
]);
