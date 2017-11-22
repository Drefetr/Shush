angular
.module('create')
.controller('CreateController',
    function CreateController($scope, $http) {
        $scope.success = false;

        $scope.url = '';

        $scope.message = {
            mid: "",
            mid_length: 16,
            key: "",
            key_length: 16,
            text: "",
            ttl: 1440
        };

        $scope.generate_key = function() {
            $scope.message.key = "";

            while($scope.message.key.length < $scope.message.key_length){
                var r = Math.random();

                $scope.message.key
                    += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
            }
        }

        $scope.generate_key();

        $scope.submit = function() {
            var post = JSON.stringify({
                'contents': sjcl.encrypt($scope.message.key, $scope.message.text),
                'mid_length': $scope.message.mid_length,
                'ttl': $scope.message.ttl
            });

            var headers = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'
                }
            };

            $http.post('api/create', post, headers).then(function(response) {
                $scope.message.mid = response.data['mid'];
                $scope.success = true;
                $scope.url = "http://shush.ch";
            });
        }
    }
);
