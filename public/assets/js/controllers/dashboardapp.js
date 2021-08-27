module.config(function ($routeProvider, $locationProvider) {
  $routeProvider
    .when("/index", {
      templateUrl: "../app/Views/Admin/Views/home.html",
      //template:"<h4>This is home page</h4>",
      //controller:"combinedController",
    })
    .when("/categories", {
      templateUrl: "../app/views/Admin/views/categories.html",
      controller: "categoryController",
    })
    .when("/listings", {
      templateUrl: "../app/views/Admin/views/listings.html",
      controller: "listingController",
    })
    .when("/users", {
      templateUrl: "../app/views/Admin/views/users.html",
      controller: "usersController",
    })
    .when("/account_types", {
      templateUrl: "../app/views/Admin/views/account_types.html",
      controller: "packagesController",
    })
    .when("/banners", {
      templateUrl: "../app/views/Admin/views/banners.html",
      //controller:"combinedController",
    })
    .when("/transactions", {
      templateUrl: "../app/views/Admin/views/transactions.html",
      //controller:"combinedController",
    })
    .otherwise({
      redirectTo: "/index",
    });
  $locationProvider.html5Mode(true);
});
