<script type="text/javascript">
		shush.controller('MessageViewController', ['$scope', '$http', function($scope, $http) {
			$scope.Success = false;
			$scope.MessageText = '';

			$scope.RetreiveMessage = function() {
				$http.get('<?php print DIR_WEBROOT; ?>/MessageView.php?i=<?php print $this->messageID; ?>')
					.success(function(data, status, headers, config) {
						var messageKey = '<?php print $this->messageKey; ?>';
						var messageText = JSON.stringify(data);
						var plainText = sjcl.decrypt(messageKey, messageText);
						$scope.MessageText = plainText;
						$scope.Success = true;

					})
					.error(function(data, status, header, config) {
						alert("Fail: " + data);
					});
			};
		}]);
</script>
<div class="row" ng-controller="MessageViewController">
	<div class="col-xs-12" ng-show="!Success">
		<div class="alert alert-info alert-dissmissable">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p>Click on the button below to view your message &mdash;<br /><br /><button class="btn btn-primary" ng-click="RetreiveMessage()">&rarr; View Message</button></p>
		</div>
	</div>
	<div class="col-xs-12" ng-show="Success">
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p>{{MessageText}}</p>
		</div>
	</div>
</div>
<div ng-show="Success">
<?php require(DIR_TEMPLATES . 'MessageCreate.tpl.php'); ?>
</div>