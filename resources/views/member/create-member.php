<div class="wrap">
	
	<h1>
		<?php _e('Add a new member', 'hegspots'); ?>
	</h1>

	<p></p>

	<div class="form-wrap form-wrap--small">

		<form action="<?php echo \Vitaminate\Routing\URL::to('member_create'); ?>" method="post">

			<div class="columns">
				<div class="avatar-wrapper">
					<img src="<?php echo config('member_default_avatar'); ?>" alt="Default avatar">
					<br>
					<a href="#"><?php _e('Change avatar','hegspots') ?></a>
				</div>

				<div>
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
							<input type="checkbox" name="activities[]" value="1"> Option 2
						</label>
						<label>
							<input type="checkbox" name="activities[]" value="2"> Option 3
						</label>
						<p>
							<a href="#">
								<?php _e('Add a new activity to the list', 'hegspots'); ?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<h2>
				<?php _e('Member\'s Profile'); ?>
			</h2>
			<div class="form-field">
				<label for="about"><?php _e('About', 'hegspots'); ?></label>
				<textarea name="about" id="input__about" cols="20" rows="5"></textarea>
			</div>

			<div class="columns">
				<div class="form-field">
					<label for="watch"><?php _e('Watch', 'hegspots'); ?></label>
					<input type="text" name="watch" id="input__watch">
				</div>

				<div class="form-field">
					<label for="bag"><?php _e('Bag', 'hegspots'); ?></label>
					<input type="text" name="bag" id="input__bag">	
				</div>

				<div class="form-field">
					<label for="book"><?php _e('Book', 'hegspots'); ?></label>
					<input type="text" name="book" id="input__book">	
				</div>

				<div class="form-field">
					<label for="grooming"><?php _e('Grooming', 'hegspots'); ?></label>
					<input type="text" name="grooming" id="input__grooming">	
				</div>

				<div class="form-field">
					<label for="style-icon"><?php _e('Style icon', 'hegspots'); ?></label>
					<input type="text" name="style-icon" id="input__style-icon">	
				</div>

				<div class="form-field">
					<label for="brand"><?php _e('Brand', 'hegspots'); ?></label>
					<input type="text" name="brand" id="input__brand">	
				</div>
			</div>

			<div class="form-field">
				<button type="submit" class="button button-primary button-large"><?php _e('Save member','hegspots') ?></button>	
			</div>

		</form>

	</div>

</div>