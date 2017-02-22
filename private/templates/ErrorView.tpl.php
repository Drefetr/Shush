<?php foreach ($this->errorMessages as $errorMessage) { ?>
<div class="row" ng-show="!Status.Success">
		<div class="col-xs-12">
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p><strong>Fatal Error:</strong> <?php print $errorMessage; ?></p>
			</div>
		</div>
</div>
<?php } ?>
<?php $this->loadTemplate('MessageCreate'); ?>