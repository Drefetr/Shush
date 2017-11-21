angular
.module('create')
.controller('CreateController',
    function CreateController($scope, $http) {
        $scope.Message = {
            MID: "",
            MIDLength: 16,
            Key: "",
            KeyLength: 16,
            TTL: 1440
        };

        $scope.GenerateKey = function() {
            $scope.Message.Key = "";

            while($scope.Message.Key.length < $scope.Message.KeyLength){
                var r = Math.random();

                $scope.Message.Key
                    += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
            }
        }

        $scope.GenerateKey();

        $scope.Submit = function() {
            $http.get('api/create').then(function(response) {
                alert(response);
            });
        }
    }
);
