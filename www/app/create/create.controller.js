angular
.module('create')
.controller('CreateController',
    function CreateController($scope, $http) {
        $scope.Message = {
            MID: "",
            MIDLength: 16,
            Key: "",
            KeyLength: 16,
            Text: "",
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
            var plainText = $scope.Message.Text;
            var cipherText = sjcl.encrypt($scope.Message.Key, plainText);

            var data = JSON.stringify({
                Message_MIDLength: $scope.Message.MIDLength,
                Message_TTL: $scope.Message.TTL,
                Message_Text: cipherText
            });

            $http.post('api/create', data).then(function(response) {
                alert(response);
            });
        }
    }
);
