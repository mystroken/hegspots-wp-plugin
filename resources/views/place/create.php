<?php
use \Vitaminate\Routing\URL; ?>

<div class="wrap">

	<h1>
	<?php if( $place->ID > 0 ): ?>
		<?php _e('Edit a place', 'hegspots'); ?>
	<?php else: ?>
		<?php _e('Add a new place', 'hegspots'); ?>
	<?php endif; ?>
	</h1>

	<p></p>

	<div class="form-wrap form-wrap--small">

		<form action="<?php echo ( $place->ID > 0 ) ? URL::to('place_edit')->with('item',$place->ID)->with('noheader', true) : URL::to('place_create')->with('noheader', true); ?>" method="post">

			<div class="form-field">
				<img id="place__img__photo" src="<?php echo $place->photo; ?>" alt="<?php echo $place->name; ?>">
				<input type="hidden" name="photo" id="place__input__photo" value="<?php echo $place->photo; ?>">
				<br>
				<a href="#" id="place__link__select-photo"><?php _e('Change photo','hegspots') ?></a>
			</div>

			<div class="columns">
				<div class="form-field">
					<label for="select__type"><?php _e('Type of place', 'hegspots'); ?></label>
					<select name="type" id="select__type">
					<?php foreach ($types as $type): ?>
						<option value="<?php echo $type->ID; ?>" <?php if( $place->type && $place->type->ID == $type->ID ) echo 'selected'; ?>><?php echo $type->name; ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-field">
					<label for="select__location__country"><?php _e('Country', 'hegspots'); ?></label>
					<select name="location__country" id="select__location__country">
						<option value="cameroun" <?php if( $place->location && $place->location->country == 'cameroun' ) echo 'selected'; ?>>Cameroun</option>
					</select>
				</div>
			</div>
			<div class="columns">
				<div class="form-field">
					<label for="input__name"><?php _e('Name', 'hegspots'); ?></label>
					<input type="text" name="name" id="input__name" value="<?php echo $place->name; ?>">
				</div>
				<div class="form-field">
					<label for="input__location__town"><?php _e('Town','hegspots'); ?></label>
					<input type="text" name="location__town" id="input__location__town" value="<?php echo ($place->location)?$place->location->town:''; ?>">
				</div>
			</div>

			<div class="form-field">
				<label for="input__description"><?php _e('Description', 'hegspots'); ?></label>
				<?php
					wp_editor( $place->description, 'input__description', [
						'textarea_name' => 'description',
						'textarea_rows' => 7,
					]);
				?>
			</div>

			<div class="form-field">
				<p>
					<?php _e('Recommended by ', 'hegspots'); ?>
				</p>
				<?php if( !empty($members) ):
					$placeRecommendators = array_map(function($item){return $item['ID'];}, $place->recommandators->toArray()); ?>
					<?php foreach ($members as $member): ?>

						<label>
							<input type="checkbox" name="recommendators[]" value="<?php echo $member->ID; ?>" <?php if(in_array($member->ID, $placeRecommendators)) echo 'checked="checked"' ?>>
							<?php echo $member->name; ?>
						</label>

					<?php endforeach; ?>
				<?php else: ?>
				<p>
					<?php sprintf(__('You have to <a href="%s">create</a> first some members.', 'hegspots'), URL::to('member_create')); ?>
				</p>
				<?php endif; ?>
			</div>

			<div class="form-field">
				<div id="map" class="map"></div>
				<input type="hidden" id="map__lng" name="map__lng" value="<?php echo (!empty($place->mapPosition->lng))?$place->mapPosition->lng:'11.51'; ?>">
				<input type="hidden" id="map__lat" name="map__lat" value="<?php echo (!empty($place->mapPosition->lat))?$place->mapPosition->lat:'3.86'; ?>">
			</div>

			<div class="form-field">
				<button type="submit" class="button button-primary button-large"><?php _e('Save place','hegspots') ?></button>
			</div>

		</form>

	</div>

</div><!-- /wrap -->
