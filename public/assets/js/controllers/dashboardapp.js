module.config(function ($routeProvider, $locationProvider) {
  $routeProvider
    .when("/index", {
      templateUrl: "../app/Views/Admin/Views/home.html",
      //template:"<h4>This is home page</h4>",
      controller: "homeController",
    })
    .when("/categories", {
      templateUrl: "../app/Views/Admin/views/categories.html",
      controller: "categoryController",
    })
    .when("/sub_category", {
      templateUrl: "../app/Views/Admin/views/sub_category.html",
      controller: "categoryController",
    })
    // .when("/edit_sub", {
    //   templateUrl: "../app/views/Admin/views/edit_sub_category.html",
    //   controller: "categoryController",
    // })
    .when("/listings", {
      templateUrl: "../app/Views/Admin/views/listings.html",
      controller: "listingController",
    })
    .when("/users", {
      templateUrl: "../app/Views/Admin/views/users.html",
      controller: "usersController",
    })
    .when("/profile", {
      templateUrl: "../app/Views/Admin/views/profile.html",
      controller: "usersController",
    })
    .when("/single_listing", {
      templateUrl: "../app/Views/Admin/views/single_listing.html",
      controller: "listingController",
    })
    .when("/account_types", {
      templateUrl: "../app/Views/Admin/views/account_types.html",
      controller: "packagesController",
    })
    // .when("/edit_packages", {
    //   templateUrl: "../app/views/Admin/views/edit_packages.html",
    //   controller: "packagesController",
    // })
    .when("/banners", {
      templateUrl: "../app/Views/Admin/views/banners.html",
      controller: "bannerController",
    })
    .when("/transactions", {
      templateUrl: "../app/Views/Admin/views/transactions.html",
      controller: "transactionController",
    })
    .when("/admins", {
      templateUrl: "../app/Views/Admin/views/admins.html",
      controller: "adminController",
    })
    .otherwise({
      redirectTo: "/index",
    });
  $locationProvider.html5Mode(true);
});
