<?php 
use \Vitaminate\Routing\URL; ?>

<div class="wrap">

	<h1>
		<?php _e('Add a new place', 'hegspots'); ?>
	</h1>

	<p></p>

	<div class="form-wrap form-wrap--small">
		
		<form action="<?php echo URL::to('place_index'); ?>" method="post">

			<div class="form-field">
				<img id="place__img__photo" src="<?php echo config('place_default_photo'); ?>" alt="Default avatar">
				<input type="hidden" name="photo" id="place__input__photo" value="<?php echo config('place_default_photo'); ?>">
				<br>
				<a href="#" id="place__link__select-photo"><?php _e('Change photo','hegspots') ?></a>
			</div>

			<div class="columns">
				<div class="form-field">
					<label for="select__type"><?php _e('Type of place', 'hegspots'); ?></label>
					<select name="type" id="select__type">
					<?php foreach ($types as $type): ?>
						<option value="<?php echo $type->ID; ?>"><?php echo $type->name; ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-field">
					<label for="select__location__country"><?php _e('Country', 'hegspots'); ?></label>
					<select name="location__country" id="select__location__country">
						<option value="cameroun">Cameroun</option>
					</select>
				</div>
			</div>
			<div class="columns">
				<div class="form-field">
					<label for="input__name"><?php _e('Name', 'hegspots'); ?></label>
					<input type="text" name="name" id="input__name">
				</div>
				<div class="form-field">
					<label for="input__location__town"><?php _e('Town','hegspots'); ?></label>
					<input type="text" name="location__town" id="input__location__town">
				</div>
			</div>

			<div class="form-field">
				<label for="input__description"><?php _e('Description', 'hegspots'); ?></label>
				<textarea name="description" id="input__description" cols="20" rows="5"></textarea>
			</div>
			
			<div class="form-field">
				<button type="submit" class="button button-primary button-large"><?php _e('Save place','hegspots') ?></button>	
			</div>

		</form>

	</div>

</div><!-- /wrap -->