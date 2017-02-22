			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<?php
				switch (@$_GET['s']) {
					case 'MessageDestroyed':
						print L10N_SUCCESS_MESSAGE_DESTROYED;
					break;
				
					default:
					break;
				}		
				?>
			</div>
