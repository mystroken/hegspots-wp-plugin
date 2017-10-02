<?php
use \Vitaminate\Routing\URL; ?>

<div class="wrap">

	<h1>
	</h1>
	<h1>
	<?php if( $member->ID > 0 ): ?>
		<?php _e('Edit a member', 'hegspots'); ?>
	<?php else: ?>
		<?php _e('Add a new member', 'hegspots'); ?>
	<?php endif; ?>
	</h1>

	<p></p>

	<div class="form-wrap form-wrap--small">

		<form action="<?php echo ( $member->ID > 0 ) ? URL::to('member_edit')->with('item',$member->ID)->with('noheader', true) : URL::to('member_create')->with('noheader', true); ?>" method="post">

			<div class="columns">
				<div class="avatar-wrapper">
					<img id="member__img__photo" src="<?php echo ($member->profile)?$member->profile->photo:config('member_default_avatar'); ?>" alt="<?php echo $member->name; ?>">
					<input type="hidden" name="photo" id="member__input__photo" value="<?php echo ($member->profile)?$member->profile->photo:''; ?>">
					<br>
					<a href="#" id="member__link__select-avatar"><?php _e('Change avatar','hegspots') ?></a>
				</div>

				<div>
					<div class="form-field">
						<label for="input__name"><?php _e('Name', 'hegspots'); ?></label>
						<input type="text" name="name" id="input__name" value="<?php echo $member->name; ?>">
					</div>
					<div class="form-field">
						<label for="select__location__country"><?php _e('Country', 'hegspots'); ?></label>
						<select name="location__country" id="select__location__country">
							<option value="cameroun" <?php if( $member->location && $member->location->country == 'cameroun' ) echo 'selected'; ?>>Cameroun</option>
						</select>
					</div>
					<div class="form-field">
						<label for="input__location__town"><?php _e('Town','hegspots'); ?></label>
						<input type="text" name="location__town" id="input__location__town" value="<?php echo ($member->location)?$member->location->town:''; ?>">
					</div>
					<div class="form-field">
						<p><?php _e('Choose the activities of the member', 'hegspots'); ?></p>
						<?php if( !empty($activities) ):
							$memberActivities = array_map(function($item){return $item['ID'];}, $member->activities->toArray()); ?>
							<?php foreach ($activities as $activity): ?>

								<label>
									<input type="checkbox" name="activities[]" value="<?php echo $activity->ID; ?>" <?php if(in_array($activity->ID, $memberActivities)) echo 'checked="checked"' ?>>
									<?php echo $activity->name; ?>
								</label>

							<?php endforeach; ?>
						<?php else: ?>
						<p>
							<?php sprintf(__('You have to <a href="%s">create</a> first some activities.', 'hegspots'), URL::to('activity_create')); ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<h2>
				<?php _e('Member\'s Profile'); ?>
			</h2>

			<div class="avatar-wrapper">
				<span><?php _e('Picture Cover','hegspots'); ?></span>
				<img id="member__img__cover" src="<?php echo ($member->profile)?$member->profile->cover:config('member_default_cover'); ?>" alt="Default avatar">
				<input type="hidden" name="cover" id="member__input__cover" value="<?php echo ($member->profile)?$member->profile->cover:config('member_default_cover'); ?>">
				<br>
				<a href="#" id="member__link__select-cover"><?php _e('Change cover','hegspots') ?></a>
			</div>

			<div class="form-field">
				<label for="input__about"><?php _e('About', 'hegspots'); ?></label>
				<?php
					wp_editor(
						(($member->profile)?$member->profile->about:''),
						'input__about',
						[
							'textarea_name' => 'about',
							'textarea_rows' => 7,
						]
					);
				?>
			</div>

			<div class="columns">
				<div class="form-field">
					<label for="input__watch"><?php _e('Watch', 'hegspots'); ?></label>
					<input type="text" name="watch" id="input__watch" value="<?php echo ($member->profile)?$member->profile->watch:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__bag"><?php _e('Bag', 'hegspots'); ?></label>
					<input type="text" name="bag" id="input__bag" value="<?php echo ($member->profile)?$member->profile->bag:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__book"><?php _e('Book', 'hegspots'); ?></label>
					<input type="text" name="book" id="input__book" value="<?php echo ($member->profile)?$member->profile->book:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__grooming"><?php _e('Grooming', 'hegspots'); ?></label>
					<input type="text" name="grooming" id="input__grooming" value="<?php echo ($member->profile)?$member->profile->grooming:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__style-icon"><?php _e('Style icon', 'hegspots'); ?></label>
					<input type="text" name="style-icon" id="input__style-icon" value="<?php echo ($member->profile)?$member->profile->style_icon:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__brand"><?php _e('Brand', 'hegspots'); ?></label>
					<input type="text" name="brand" id="input__brand" value="<?php echo ($member->profile)?$member->profile->brand:''; ?>">
				</div>

				<div class="form-field">
					<label for="input__instagram"><?php _e('Instagram', 'hegspots'); ?></label>
					<input type="text" name="instagram" id="input__instagram" value="<?php echo $member->instagram; ?>">
				</div>
			</div>

			<div class="form-field">
				<button type="submit" class="button button-primary button-large"><?php _e('Save member','hegspots') ?></button>
			</div>

		</form>

	</div>

</div>
