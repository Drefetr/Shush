<!DOCTYPE html>
<html>
	<head lang="en">
		<title>Shush</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
		<script type="text/javascript" src="<?php print DIR_WEBROOT; ?>/libraries/SJCL.js"></script>
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

		var shush = angular.module('Shush', ['ngclipboard']);

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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php print DIR_WEBROOT; ?>/css/Shush.css" />
		<link rel="icon" type="image/x-icon" href="<?php print DIR_WEBROOT; ?>/favicon.ico" />
	</head>
	<body ng-app="Shush">
		<header>
			<nav id="PrimaryNavigation" class="navbar navbar-inverse navbar-static-top">
				<div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target="#PrimaryNavigation" aria-expanded="false" aria-controls="PrimaryNavigation" class="navbar-toggle collapsed">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php print DIR_WEBROOT; ?>/index.php" class="navbar-brand"><strong>Shush</strong></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul role="tablist" class="nav navbar-nav">
						<li><a href="<?php print DIR_WEBROOT; ?>/index.php">Frontpage</a></li>
						<li><a href="https://github.com/Drefetr/Shush/tree/master/www/docs">Documentation</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="container-fluid" id="PageContents">
