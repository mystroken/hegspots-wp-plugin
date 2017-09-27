<?php
use \Vitaminate\Routing\URL; ?>

<div class="hegspots__wrapper">

	<div class="hegspots-hero">
		<div class="hegspots-hero__cover">
			<img src="<?php echo asset('img/places-hero.jpeg'); ?>" alt="HEG Spots Cover">
		</div>
		<h2 class="hegspots-hero__title">
			<?php _e('HEG Spots', 'hegspots'); ?>
		</h2>
	</div>


	<form action="" method="get" class="hegspots-filter">
		<select name="type" id="hegspots-filter__type">
			<option value=""><?php _e('ALL PLACES', 'hegspots'); ?></option>
		<?php foreach( $types as $type ):  ?>
			<option value="<?php echo $type->ID; ?>"<?php if( $currentTypeFilter == $type->ID ) echo ' selected'; ?>>
				<?php echo ucfirst(strtolower($type->name)); ?>
			</option>
		<?php endforeach; ?>
		</select>
		<span>
			<?php _e('BASED IN', 'hegspots'); ?>
		</span>
		<select name="location" id="hegspots-filter__location">
			<option value=""><?php _e('ALL LOCATION', 'hegspots'); ?></option>
		<?php foreach( $locations as $location ):  ?>
			<option value="<?php echo $location->ID; ?>"<?php if( $currentLocationFilter == $location->ID ) echo ' selected'; ?>>
				<?php echo $location; ?>
			</option>
		<?php endforeach; ?>
		</select>
	</form>


	<section class="section">
		<div class="section__content">
		<?php if( sizeof($places) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($places as $place ): ?>
				<div class="card card--bordered">
				    <a class="card__image" href="<?php echo URL::to('front_places')->with('item',$place->ID); ?>" title="<?php echo $place->name; ?>">
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
				        <div class="place-recommendations">
				        	<span><?php _e('Recommended by', 'hegspots'); ?></span>&nbsp;&nbsp;
			        	<?php foreach( $place->recommandators as $member ): ?>
    		        		<a href="#" title="<?php echo $member->name; ?>">
    		        			<img src="<?php echo $member->profile->photo; ?>" class="pic pic__thumb pic--rounded" alt="<?php _e('by member', 'hegspots'); ?> <?php echo $member->name; ?>">
    		        		</a>
    		        	<?php endforeach; ?>
				        </div>
				    </div><!-- ./card__content -->
				</div><!-- ./card -->
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
		</div>
	</section>

</div>
