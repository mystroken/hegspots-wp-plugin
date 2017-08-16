<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e('Places', 'hegspots'); ?></h1>
	<a href="<?php echo $subRouter->generateUrl('place_create'); ?>" class="page-title-action"><?php _e('Add New', 'hegspots'); ?></a>
	<hr class="wp-header-end">

	<form method="post" id="hegspots-members-filter">
		<?php
		$placeListTable->prepare_items();
		$placeListTable->display(); ?>
	</form>

</div><!-- .wrap -->