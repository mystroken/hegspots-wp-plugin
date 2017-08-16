<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e('Members', 'hegspots'); ?>
	</h1>
	<a href="<?php echo $subRouter->generateUrl('member_create'); ?>" class="page-title-action"><?php _e('Add New', 'hegspots'); ?></a>
	<hr class="wp-header-end">

	<form method="post" id="hegspots-members-filter">
		<?php
		$memberListTable->prepare_items();
		$memberListTable->display(); ?>
	</form>

</div><!-- .wrap -->