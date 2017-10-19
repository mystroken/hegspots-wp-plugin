<?php
use \Vitaminate\Routing\URL; ?>

<div class="hegspots__wrapper">

	<header class="heading">
		<h1 class="heading__title"><?php echo $place->name; ?></h1>
		<div class="heading__subtitle__top">
			<a href="<?php echo URL::to('front_places')->with('type', $place->type->ID); ?>">
				<?php echo strtoupper($place->type->name); ?>
			</a>,&nbsp;
			<a href="<?php echo URL::to('front_places')->with('location', $place->location->ID)->with('type', null); ?>">
				<?php echo strtoupper($place->location->town); ?>
			</a>
		</div>
	</header>

	<div class="card card--large card--bordered">
	    <div class="card__image">
	    	<img src="<?php echo $place->photo; ?>" alt="<?php echo $place->name; ?>">
	    </div><!-- ./card__image -->
	    <div class="card__content">
	    	<div class="hegspots-texte__container hegspots-texte__container--padding hegspots-texte__container--description">
	    		<?php echo $place->description; ?>
	    	</div>
	    </div><!-- ./card__content -->
	</div><!-- ./card -->

	<section class="section">
		<header class="section__title">
			<h3>
				<?php _e('What\'s Nearby', 'hegspots'); ?>
			</h3>
		</header>
		<div class="section__content">
		<?php if( sizeof($nearbyPlaces) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($nearbyPlaces as $place ): ?>
				<div class="card card--bordered">
				    <a class="card__image" href="<?php echo URL::to('front_places')->with('item',$place->ID)->with('location', null); ?>" title="<?php echo $place->name; ?>">
				    	<img src="<?php echo $place->photo; ?>" alt="<?php echo $place->name; ?>">
				    </a><!-- ./card__image -->
				    <div class="card__content card__content--centered">
				    	<h4 class="card__subtitle"><?php echo $place->type->name; ?></h4>
				    	<h3 class="card__title">
				    		<a href="<?php echo URL::to('front_places')->with('item',$place->ID); ?>">
				    			<?php echo ucfirst($place->name); ?>
				    		</a>
				    	</h3>
				    	<div class="card__subtitle"><?php echo $place->location; ?></div>
				        <?php display_recommendators($place->recommandators); ?>
				    </div><!-- ./card__content -->
				</div><!-- ./card -->
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
		</div>
	</section>

</div>
