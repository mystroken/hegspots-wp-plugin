<?php 
use \Vitaminate\Routing\URL; ?>

<div class="wrap nosubsub">
<h1 class="wp-heading-inline"><?php _e('Types of place', 'hegspots'); ?></h1>


<hr class="wp-header-end">

<div id="ajax-response"></div>

<div id="col-container" class="wp-clearfix">

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
	<h2><?php _e('Add a new type of place', 'hegspots'); ?></h2>
	<form id="addtypeofplace" method="post" action="<?php echo URL::to('type_of_place_index'); ?>" class="validate">
		<div class="form-field form-required term-name-wrap">
			<label for="photo"><?php _e('Picture', 'hegspots'); ?></label>
			<input name="photo" id="photo" type="text" aria-required="true" required>
			<p><?php _e('The picture of the type of place.', 'hegspots'); ?></p>
		</div>
		<div class="form-field form-required term-name-wrap">
			<label for="name"><?php _e('Name', 'hegspots'); ?></label>
			<input name="name" id="name" type="text" aria-required="true" required>
			<p><?php _e('The name of the type of place.', 'hegspots'); ?></p>
		</div>
		<div class="form-field form-required term-name-wrap">
			<label for="description"><?php _e('Description', 'hegspots'); ?></label>
			<input name="description" id="description" type="text">
			<p><?php _e('Some text that describe the type of place.', 'hegspots'); ?></p>
		</div>
		<p class="submit">
			<input type="submit" id="submit" class="button button-primary" value="<?php _e('Add a new type of place', 'hegspots'); ?>">
		</p>
	</form>
</div>

</div>
</div><!-- /col-left -->

<div id="col-right">
	<div class="col-wrap">
		<form id="posts-filter" method="post">
			<table class="wp-list-table widefat fixed striped tags">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All', 'hegspots') ?></label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
							<a href="#">
								<span><?php _e('Name', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
							<a href="#">
								<span><?php _e('Description', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="slug" class="manage-column column-slug sortable desc">
							<a href="#">
								<span><?php _e('Slug', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="actions" class="manage-column column-description sortable desc">
							<a href="#">
								<span><?php _e('Actions', 'hegspots'); ?></span>
							</a>
						</th>
					</tr>
				</thead>

				<tbody id="the-list">
				<?php if(count($typesOfPlace) > 0): ?>
					
					<?php foreach ($typesOfPlace as $typeOfPlace): ?>
					<tr>
						<th scope="row" class="check-column">&nbsp;</th>
						<td class="name column-name has-row-actions column-primary">
							<strong>
								<a class="row-title" href="#">
									<?php echo $typeOfPlace->name; ?>
								</a>
							</strong>
						</td>
						<td class="description column-name has-row-actions column-primary">
							<?php echo $typeOfPlace->description; ?>
						</td>
						<td class="slug column-slug">
							<?php echo $typeOfPlace->slug; ?>
						</td>
						<td class="description column-description">
							<a href="<?php echo URL::to('type_of_place_delete') . '&amp;id='.$typeOfPlace->ID; ?>">
								<?php _e('delete', 'hegspots'); ?>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<th>&nbsp;</th>
						<td rowspan="3">
							<?php _e('There is no data yet.', 'hegspots'); ?>
						</td>
					</tr>
				<?php endif; ?>
				</tbody>

				<tfoot>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All', 'hegspots') ?></label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
							<a href="#">
								<span><?php _e('Name', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
							<a href="#">
								<span><?php _e('Description', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="slug" class="manage-column column-slug sortable desc">
							<a href="#">
								<span><?php _e('Slug', 'hegspots'); ?></span>
							</a>
						</th>
						<th scope="col" id="description" class="manage-column column-description sortable desc">
							<a href="#">
								<span><?php _e('Actions', 'hegspots'); ?></span>
							</a>
						</th>
					</tr>
				</tfoot>

			</table>
	
			<br class="clear">
		</form>

	</div><!-- /col-wrap -->
</div><!-- /col-right -->

</div><!-- /col-container -->
</div>