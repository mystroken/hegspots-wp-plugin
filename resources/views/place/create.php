<div class="wrap">

	<form id="addactivity" method="post" action="<?php echo $subRouter->generateUrl('place_create'); ?>" class="validate">
		<div class="form-field form-required term-name-wrap">
			<label for="name"><?php _e('Name', 'hegspots'); ?></label>
			<input name="name" id="name" type="text" aria-required="true" required>
		</div>
		<p class="submit">
			<input type="submit" id="submit" class="button button-primary" value="<?php _e('Add a new place', 'hegspots'); ?>">
		</p>
	</form>

</div><!-- /wrap -->