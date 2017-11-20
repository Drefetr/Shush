<!DOCTYPE html>
<html ng-app="shush">
	<head lang="en">
		<title>Shush</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script type="text/javascript" src="app/libraries/angular/angular.min.js"></script>
		<script type="text/javascript" src="app/libraries/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="app/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="app/libraries/sjcl/sjcl.js"></script>
		<script type="text/javascript" src="<?php print DIR_WEBROOT; ?>/libraries/clipboard.min.js"></script>
		<script type="text/javascript" src="<?php print DIR_WEBROOT; ?>/libraries/ngclipboard.min.js"></script>
		<script type="text/javascript">
		function getRandomString(length){
			var randomString = "";

			while(randomString.length < length && length > 0){
		    		var r = Math.random();
		    		randomString += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
			}

			return randomString;
		}

		var shush = angular.module('shush', ['ngclipboard']);

		shush.service('Status',function(){
			this.Success = false;
		});

		shush.controller('NewMessageController', ['$scope', '$http', function($scope, $http) {
				$scope.NewMessage = {
					MID: "",
					MIDLength: <?php print MESSAGE_MID_LENGTH_DEFAULT; ?>,
					Key: "" + getRandomString(16),
					KeyLength: <?php print MESSAGE_KEY_LENGTH_DEFAULT; ?>,
					TTL: <?php print MESSAGE_TTL_DEFAULT; ?>
				};

				$scope.CreateMessageKey = function() {
						$scope.NewMessage.Key = getRandomString($scope.NewMessage.KeyLength);
				};

				$scope.SetMessageKey = function() {
					$scope.NewMessage.KeyLength = $scope.NewMessage.Key.length;
				}

				$scope.NewMessage_Success = false;

				$scope.NewMessage_Submit = function() {
					$('.alert-danger').hide();

					var plainText = $("#NewMessage_Text").val();
					var cipherText = sjcl.encrypt($scope.NewMessage.Key, plainText);

					var data = $.param({
						JSON: JSON.stringify({
							NewMessage_MIDLength: $scope.NewMessage.MIDLength,
							NewMessage_TTL: $scope.NewMessage.TTL,
							NewMessage_Text: cipherText
						})
					});

					var conf = {
						headers : {
							'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'
						}
					};

					$http.post('<?php print DIR_WEBROOT;?>/MessageCreate.php', data, conf)
						.success(function (data, status, headers, config) {
							$scope.NewMessage.MID = data;
							$scope.NewMessage_Success = true;
							Status.Success = true;
						})
						.error(function (data, status, header, config) {
							alert("err" + status + "");
						});
					};
		}]);
		</script>
		<link rel="stylesheet" href="app/libraries/bootstrap/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/Shush.css" />
		<link rel="icon" type="image/x-icon" href="favicon.ico" />
	</head>
	<body>
		<div class="container-fluid" id="PageContents">
			<div class="row">
				<div class="col-xs-12">
					<header>
						<h1><a href="<?php print URL_BASE; ?>">Shush</a></h1>
					</header>
				</div>
			</div>
