<div class="wrap nosubsub">
<h1 class="wp-heading-inline"><?php _e('Activities', 'hegspots'); ?></h1>


<hr class="wp-header-end">

<div id="ajax-response"></div>

<div id="col-container" class="wp-clearfix">

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
	<h2><?php _e('Add a new activity', 'hegspots'); ?></h2>
	<form id="addactivity" method="post" action="<?php echo $subRouter->generateUrl('activity_index'); ?>" class="validate">
		<div class="form-field form-required term-name-wrap">
			<label for="name"><?php _e('Name', 'hegspots'); ?></label>
			<input name="name" id="name" type="text" aria-required="true" required>
			<p><?php _e('The name of the activity.', 'hegspots'); ?></p>
		</div>
		<p class="submit">
			<input type="submit" id="submit" class="button button-primary" value="<?php _e('Add a new activity', 'hegspots'); ?>">
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
				<?php if(count($activities) > 0): ?>
					
					<?php foreach ($activities as $activity): ?>
					<tr>
						<th scope="row" class="check-column">&nbsp;</th>
						<td class="name column-name has-row-actions column-primary">
							<strong>
								<a class="row-title" href="#">
									<?php echo $activity->name; ?>
								</a>
							</strong>
						</td>
						<td class="slug column-slug">
							<?php echo $activity->slug; ?>
						</td>
						<td class="description column-description">
							<a href="<?php echo add_query_arg( array( 'page' => 'heg-spots-activities.php', 'action' => 'delete', 'id' => $activity->ID ), admin_url( 'admin.php' ) ) ?>">
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