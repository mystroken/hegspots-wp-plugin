<?php
use \Vitaminate\Routing\URL; ?>

<div class="hegspots__wrapper">

	<header class="heading">
		<h1 class="heading__title"><?php echo $member->name; ?></h1>
		<div class="heading__subtitle__top">
		<?php if( sizeof($member->activities) > 0 ): ?>
			<?php foreach($member->activities as $activity ): ?>
				<a href="<?php echo URL::to('front_members')->with('activity', $activity->ID); ?>">
					<?php echo strtoupper($activity->name); ?>
				</a>,&nbsp;
			<?php endforeach; ?>
		<?php endif; ?>
			<a href="<?php echo URL::to('front_members')->with('location', $member->location->ID)->with('activity', null); ?>">
				<?php echo strtoupper($member->location->town); ?>
			</a>
		</div>
	</header>

	<div class="card card--large card--bordered">
	    <div class="card__image">
	    	<img src="<?php echo $member->profile->cover; ?>" alt="<?php echo $member->name; ?>">
	    </div><!-- ./card__image -->
	    <div class="card__content">
	    	<div class="hegspots-texte__container hegspots-texte__container--padding hegspots-texte__container--description">

	    		<?php echo $member->profile->about; ?>

	    		<p></p><hr><br>

	    		<div class="hegspots-profile">

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Brand</div>
	    				<div><?php echo $member->profile->brand; ?></div>
	    			</div>

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Watch</div>
	    				<div><?php echo $member->profile->watch; ?></div>
	    			</div>

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Book</div>
	    				<div><?php echo $member->profile->book; ?></div>
	    			</div>

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Style Icon</div>
	    				<div><?php echo $member->profile->style_icon; ?></div>
	    			</div>

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Grooming</div>
	    				<div><?php echo $member->profile->grooming; ?></div>
	    			</div>

	    			<div class="hegspots-profile__item">
	    				<div class="hegspots-profile__item__title">Bag</div>
	    				<div><?php echo $member->profile->bag; ?></div>
	    			</div>
	    		</div>

	    	</div>
	    </div><!-- ./card__content -->
	</div><!-- ./card -->


	<?php if( sizeof($member->recommandedPlaces) > 0 ): ?>
	<section class="section">
		<header class="section__title">
			<h2>
				<?php _e('Recommended Places', 'hegspots'); ?>
			</h2>
		</header>
		<div class="section__content">
			<div class="grid-container">
			<?php foreach($member->recommandedPlaces as $place ): ?>
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
				    </div><!-- ./card__content -->
				</div><!-- ./card -->
			<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="section">
		<header class="section__title">
			<h3>
				<?php _e('Other HEG Members', 'hegspots'); ?>
			</h3>
		</header>
		<div class="section__content">
		<?php if( sizeof($otherMembers) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($otherMembers as $member ): ?>
				<div class="card card--bordered">
				    <a class="card__image" href="<?php echo URL::to('front_members')->with('item',$member->ID)->with('location', null); ?>" title="<?php echo $member->name; ?>">
				    	<img src="<?php echo $member->profile->photo; ?>" alt="<?php echo $member->name; ?>">
				    </a><!-- ./card__image -->
				    <div class="card__content card__content--centered">
				    	<h3 class="card__title">
				    		<a href="<?php echo URL::to('front_members')->with('item',$member->ID); ?>">
				    			<?php echo ucfirst($member->name); ?>
				    		</a>
				    	</h3>
				    	<div class="card__subtitle"><?php echo $member->location; ?></div>
				    </div><!-- ./card__content -->
				</div><!-- ./card -->
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
		</div>
	</section>

</div>
