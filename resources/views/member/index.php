<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php use Vitaminate\Routing\URL;

        _e('Members', 'hegspots'); ?>
	</h1>
	<a href="<?php echo URL::to('member_create'); ?>" class="page-title-action"><?php _e('Add New', 'hegspots'); ?></a>
	<hr class="wp-header-end">

	<form method="post" id="hegspots-members-filter">
		<?php
		$memberListTable->prepare_items();
		$memberListTable->display(); ?>
	</form>

</div><!-- .wrap -->