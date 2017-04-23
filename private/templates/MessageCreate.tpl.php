<div ng-controller="NewMessageController">
	<div class="row" ng-show="NewMessage_Success">
		<div class="col-xs-12">
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p>Your message was created successfully &mdash; And can be viewed at the URL below; or, you can <a href="<?php print DIR_WEBROOT; ?>">destroy it now</a>.</p>
				<input name="Message_URL" id="Message_URL" class="form-control" value="<?php print DIR_WEBROOT; ?>/{{NewMessage.MID}}/{{NewMessage.Key}}" /><br />
				<button class="btn btn-default copy" ngclipboard data-clipboard-action="copy" data-clipboard-target="#Message_URL">Copy Message URL</button>
			</div>
		</div>
	</div>
	<?php if (isset($this->errorMessage) && !empty($this->errorMessage)) { ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p><?php print $this->errorMessage; ?></p>
			</div>
		</div>
	</div>
	<?php } ?>
	<form ng-submit="NewMessage_Submit()" method="post" name="NewMessageForm" id="NewMessageForm" novalidate="novalidate">
		<div class="row">
			<div class="col-xs-12">
				<label for="NewMessage_Text" class="label_block"><span style="color: #666;">New Message</span> / Message Text:</label><br />
				<textarea id="NewMessage_Text" name="NewMessage_Text" rows="6" class="form-control" ng-model="NewMessage_Text.value" ng-required="true"></textarea>
				<br />
				<a class="btn btn-default" role="button" data-toggle="collapse" href="#MessageOptions" aria-expanded="false" aria-controls="MessageOptions">+ Message Options</a>
				<br /><br />
				<div class="collapse" id="MessageOptions">
					<div class="well">
						<div class="form-group">
							<label for="NewMessage_MIDLength">Message MID Length {<?php print MESSAGE_MID_LENGTH_MIN; ?>, ..., <?php print MESSAGE_MID_LENGTH_MAX; ?>}</label>
							<input type="number" id="NewMessage_MIDLength" name="NewMessage_MIDLength" min="<?php print MESSAGE_MID_LENGTH_MIN; ?>" max="<?php print MESSAGE_MID_LENGTH_MAX; ?>" ng-model="NewMessage.MIDLength" ng-required="true" />
							<span ng-show="NewMessageForm.NewMessage_MIDLength.$error.min" class="text-danger"><?php print ERROR_MESSAGE_ID_TOO_SHORT; ?></span>
							<span ng-show="NewMessageForm.NewMessage_MIDLength.$error.max" class="text-danger">Message MID Length must be less than or equal to <?php print MESSAGE_MID_LENGTH_MAX; ?></span>
							<span ng-show="NewMessageForm.NewMessage_MIDLength.$error.number" class="text-danger">Message MID Length must be a valid integer between <?php print MESSAGE_MID_LENGTH_MIN; ?> and <?php print MESSAGE_MID_LENGTH_MAX; ?> (inclusive).</span>
							<span ng-show="NewMessageForm.NewMessage_MIDLength.$error.required" class="text-danger"><?php print ERROR_MESSAGE_ID_NULL_OR_EMPTY; ?></span>
						</div>
						<div class="form-group">
							<label for="NewMessage_KeyLength">Message Key Length {<?php print MESSAGE_KEY_LENGTH_MIN; ?>, ..., <?php print MESSAGE_KEY_LENGTH_MAX; ?>}</label>
							<input type="number" id="NewMessage_KeyLength" name="NewMessage_KeyLength" min="<?php print MESSAGE_KEY_LENGTH_MIN; ?>" max="<?php MESSAGE_KEY_LENGTH_MAX; ?>" ng-model="NewMessage.KeyLength" ng-required="true" ng-change="CreateMessageKey()" />
							<span ng-show="NewMessageForm.NewMessage_KeyLength.$error.min" class="text-danger">Message Key Length must be greater than or equal to <?php print MESSAGE_KEY_LENGTH_MIN; ?>.</span>
							<span ng-show="NewMessageForm.NewMessage_KeyLength.$error.max" class="text-danger">Message Key Length must be less than or equal to <?php print MESSAGE_KEY_LENGTH_MAX; ?>.</span>
							<span ng-show="NewMessageForm.NewMessage_KeyLength.$error.number" class="text-danger">Message Key Length must be a valid integer between <?php print MESSAGE_KEY_LENGTH_MIN; ?> and <?php print MESSAGE_KEY_LENGTH_MAX; ?> (inclusive).</span>
							<span ng-show="NewMessageForm.NewMessage_KeyLength.$error.required" class="text-danger"><?php print ERROR_MESSAGE_KEY_NULL_OR_EMPTY; ?></span>
						</div>
						<div class="form-group">
							<label for="NewMessage_Key">Message Key</label>
							<input type="text" id="NewMessage_Key" name="NewMessage_Key" ng-model="NewMessage.Key" ng-maxlength="NewMessage.KeyLength" />
						</div>
						<div class="form-group">
							<label for="NewMessage_TTL">Message Time-to-Live (min) {<?php print MESSAGE_TTL_MIN; ?>, ..., <?php print MESSAGE_TTL_MAX; ?>}</label>
							<input type="number" id="NewMessage_TTL" name="NewMessage_TTL" min="<?php print MESSAGE_TTL_MIN; ?>" max="<?php print MESSAGE_TTL_MAX; ?>" ng-model="NewMessage.TTL" ng-required="true" />
							<span ng-show="NewMessageForm.NewMessage_TTL.$error.min" class="text-danger">Message Time-to-Live must be greater than or equal to <?php print MESSAGE_TTL_MIN; ?></span>
							<span ng-show="NewMessageForm.NewMessage_TTL.$error.max" class="text-danger">Message Time-to-Live must be less than or equal to <?php print MESSAGE_TTL_MAX; ?></span>
							<span ng-show="NewMessageForm.NewMessage_TTL.$error.number" class="text-danger">Message Time-to-Live must be a valid integer between <?php print MESSAGE_TTL_MIN; ?> and <?php print MESSAGE_TTL_MAX; ?> (inclusive).</span>
							<span ng-show="NewMessageForm.NewMessage_TTL.$error.required" class="text-danger">Message Time-to-Live must not be empty (or null).</span>
						</div>
					</div>
				</div>
				<input type="submit" id="NewMessage_Submit" name="NewMessage_Submit" class="btn btn-primary" value="&rarr; Save Message" ng-disabled="NewMessageForm.$invalid" />
			</div>
		</div>
	</form>
</div>
