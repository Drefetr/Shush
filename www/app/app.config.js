angular
.module('shush')
.config(['$httpProvider', '$routeProvider', '$locationProvider',
    function config($httpProvider, $routeProvider, $locationProvider) {
        $locationProvider.html5Mode({
            enabled: true
        });

        $routeProvider
        .when('/create', {
            templateUrl: 'app/create/create.tpl.html',
            controller: 'CreateController',
            controllerAs: 'CreateController'
        })
        .when('/read', {
            templateUrl: 'app/read/read.tpl.html',
            controller: 'ReadController',
            controllerAs: 'ReadController'
        })
        .otherwise({
            redirectTo: '/create'
        });
    }
]);
