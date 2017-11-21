angular
.module('read')
.controller('ReadController',
    function ReadController($scope, $http) {
        $scope.success = false;

        $scope.message = {
            mid: "2s2",
            mid_length: 16,
            key: "",
            key_length: 16,
            text: "",
            ttl: 1440
        };

        $scope.load_message = function() {
            $http.get('api/read/' + $scope.message.mid + "").then(function(response) {
                alert("?");
                var canvas = document.getElementById("myCanvas");
                var ctx = canvas.getContext("2d");
                ctx.font = "30px Arial";
                ctx.fillText("" + response.data, 10, 50);
                $scope.success = true;
            });
        };
    }
);
