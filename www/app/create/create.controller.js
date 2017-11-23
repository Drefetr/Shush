/**
 *
 */
angular
.module('create')
.controller('CreateController',
    function CreateController($scope, $http) {
        /**
         *
         */
        $scope.success = false;

        /**
         *
         */
        $scope.delete_url = '';

        /**
         *
         */
        //$scope.read_url = function(mid, key) {
        //    var read_url = "https://shush.ch/read/" + mid + "/" + key;
        //    return read_url;
        //};

        $scope.read_url = '';

        /**
         *
         */
        $scope.message = {};

        /**
         *
         */
        $scope.generate_key = function() {
            $scope.message.key = "";

            while($scope.message.key.length < $scope.message.key_length){
                var r = Math.random();

                $scope.message.key +=
                    (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
            }
        }

        /**
         * Initialise CreateController.
         */
        $scope.init = function() {
            $scope.message = {
                contents: "",
                mid: "",
                mid_length: 16,
                key: "",
                key_length: 16,
                text: "",
                ttl: 1440
            };

            $scope.generate_key();
        }

        $scope.init();

        /**
         *
         */
        $scope.submit = function() {
            $scope.message.contents = sjcl.encrypt($scope.message.key, $scope.message.text);

            var post = JSON.stringify({
                'contents': $scope.message.contents,
                'mid_length': $scope.message.mid_length,
                'ttl': $scope.message.ttl
            });

            // HTTP headers:
            var headers = {
                headers: {
                    'Content-Type': 'application/x-www-form; charset=utf-8;'
                }
            };

            $http.post('api/create', post, headers).then(function(response) {
                var mid = $scope.message.mid = response.data.mid;
                var key = $scope.message.key;

                $scope.read_url = `https://shush.ch/read/${mid}/${key}`;
                $scope.delete_url = `https://shush.ch/delete/${mid}/${key}`;

                $scope.success = true;

                // Reinitialise; allowing creation of a new message.
                $scope.init();
            });
        }
    }
);
