<?php
use \Vitaminate\Routing\URL; ?>

<div class="hegspots__wrapper">

	<header class="heading">
		<h1 class="heading__title">
			<?php _e('HegSpots', 'hegspots') ?>
		</h1>
		<div class="heading__subtitle__top">
			<?php _e('This item does not exist or it already has been deleted.', 'hegspots'); ?>
		</div>
		<p></p>
		<p>
			<a href="<?php echo URL::to('front_home'); ?>">
				<?php _e('&larr; Return home', 'hegspots'); ?>
			</a>
		</p>
	</header>

</div>
