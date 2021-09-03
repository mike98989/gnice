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
    .when("/sub_category", {
      templateUrl: "../app/views/Admin/views/sub_category.html",
      controller: "categoryController",
    })
    .when("/edit_sub", {
      templateUrl: "../app/views/Admin/views/edit_sub_category.html",
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
    .when("/profile", {
      templateUrl: "../app/views/Admin/views/profile.html",
      controller: "usersController",
    })
    .when("/single_listing", {
      templateUrl: "../app/views/Admin/views/single_listing.html",
      controller: "listingController",
    })
    .when("/account_types", {
      templateUrl: "../app/views/Admin/views/account_types.html",
      controller: "packagesController",
    })
    .when("/edit_packages", {
      templateUrl: "../app/views/Admin/views/edit_packages.html",
      controller: "packagesController",
    })
    .when("/banners", {
      templateUrl: "../app/views/Admin/views/banners.html",
      controller: "bannerController",
    })
    .when("/transactions", {
      templateUrl: "../app/views/Admin/views/transactions.html",
      controller: "transactionController",
    })
    .when("/admins", {
      templateUrl: "../app/views/Admin/views/admins.html",
      controller: "adminController",
    })
    .otherwise({
      redirectTo: "/index",
    });
  $locationProvider.html5Mode(true);
});
