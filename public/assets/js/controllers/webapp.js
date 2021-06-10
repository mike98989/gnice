
module.config(function($routeProvider,$locationProvider){
    $routeProvider
        .when('/home',{
            templateUrl:"../views/staff/views/home.php",
            controller:"homeController",
        })
        .otherwise({
            redirectTo:"/home"
        })
        $locationProvider.html5Mode(true);
})