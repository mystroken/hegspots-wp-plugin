<div class="wrap">
	
	<h1>
		<?php _e('Add a new member', 'hegspots'); ?>
	</h1>

	<div class="form-wrap">

		<form action="<?php echo $subRouter->generateUrl('member_create'); ?>" method="post">

			<div class="row">

				<div class="col-s-12 col-m-4">
					<?php _e('Picture Profile', 'hegspots'); ?>
				</div>

				<div class="col-s-12 col-m-4">
					<h2>
						<?php _e('Member\'s Identity'); ?>
					</h2>
					<div class="form-field">
						<label for="name"><?php _e('Name', 'hegspots'); ?></label>
						<input type="text" name="name" id="input__name">
					</div>
					<div class="form-field">
						<label for="instagram"><?php _e('Instagram', 'hegspots'); ?></label>
						<input type="text" name="instagram" id="input__instagram">
					</div>
					<div class="form-field">
						<label for="location"><?php _e('Location', 'hegspots'); ?></label>
						<input type="text" name="location" id="input__location">
					</div>
					<div class="form-field">
						<p><?php _e('Choose the activities of member', 'hegspots'); ?></p>
						<label>
							<input type="checkbox" name="activities[]" value="0"> Option 1
						</label>
						<label>
							<input type="checkbox" name="activities[]" value="0"> Option 1
						</label>
						<label>
							<input type="checkbox" name="activities[]" value="0"> Option 1
						</label>
						<p>
							<a href="#">
								<?php _e('Add a new activity to the list', 'hegspots'); ?>
							</a>
						</p>
					</div>
				</div>

				<div class="col-s-12 col-m-4">
					<h2>
						<?php _e('Member\'s Profile'); ?>
					</h2>
					<table style="width: 100%">
						<tr class="form-field">
							<td>
								<label for="watch"><?php _e('Watch', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="watch" id="input__watch">
							</td>
						</tr>
						<tr class="form-field">
							<td>
								<label for="bag"><?php _e('Bag', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="bag" id="input__bag">
							</td>
						</tr>

						<tr class="form-field">
							<td>
								<label for="book"><?php _e('Book', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="book" id="input__book">
							</td>
						</tr>

						<tr class="form-field">
							<td>
								<label for="grooming"><?php _e('Grooming', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="grooming" id="input__grooming">
							</td>
						</tr>

						<tr class="form-field">
							<td>
								<label for="style-icon"><?php _e('Style icon', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="style-icon" id="input__style-icon">
							</td>
						</tr>

						<tr class="form-field">
							<td>
								<label for="brand"><?php _e('Brand', 'hegspots'); ?></label>
							</td>
							<td>
								<input type="text" name="brand" id="input__brand">
							</td>
						</tr>
					</table>
				</div>

			</div><!-- /row -->

		</form>

	</div>

</div>