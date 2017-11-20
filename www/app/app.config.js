angular
.module('shush')
.config(['$httpProvider', '$routeProvider', '$locationProvider',
    function config($httpProvider, $routeProvider, $locationProvider) {
        $locationProvider.html5Mode({
            enabled: true
        });

        $routeProvider
        .when('/', {
            templateUrl: 'app/create/create.tpl.html',
            controller: 'CreateController'
        })
        .otherwise({
            redirectTo: '/'
        });
    }
]);
