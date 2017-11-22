angular
.module('read')
.controller('ReadController',
    function ReadController($scope, $http, $routeParams) {
        $scope.success = false;

        $scope.message = {
            contents: "",
            mid: $routeParams.mid,
            key: $routeParams.key,
            text: "",
            ttl: 1440
        };

        $scope.load_message = function() {
            $http.get('api/read/' + $scope.message.mid + "").then(function(response) {
                $scope.message.contents = JSON.parse(response.data.contents);
                $scope.message.text = sjcl.decrypt($scope.message.key, response.data.contents);
                $scope.success = true;
            });
        };
    }
);
