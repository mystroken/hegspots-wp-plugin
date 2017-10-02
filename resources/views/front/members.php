<?php
use \Vitaminate\Routing\URL; ?>

<div class="hegspots__wrapper">

	<div class="hegspots-hero">
		<div class="hegspots-hero__cover">
			<img src="<?php echo asset('img/members-hero.jpeg'); ?>" alt="HEG Members Cover">
		</div>
		<h2 class="hegspots-hero__title">
			<?php _e('HEG Members', 'hegspots'); ?>
		</h2>
	</div>


	<form action="" method="get" class="hegspots-filter">
		<select name="activity" id="hegspots-filter__activity">
			<option value=""><?php _e('ALL MEMBERS', 'hegspots'); ?></option>
		<?php foreach( $activities as $activity ):  ?>
			<option value="<?php echo $activity->ID; ?>"<?php if( $currentActivityFilter == $activity->ID ) echo ' selected'; ?>>
				<?php echo ucfirst(strtolower($activity->name)); ?>
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
		<?php if( sizeof($members) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($members as $member ): ?>
				<div class="card card--bordered">
				    <a class="card__image" href="<?php echo URL::to('front_members')->with('item',$member->ID); ?>" title="<?php echo $member->name; ?>">
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

<?php if( true === $isThereNext ): ?>
	<section class="section">
		<div class="section__content">
			<div class="hegspots-paginate">
				<a id="hegspots-loadMoreLink" href="<?php echo URL::to('front_members')->with('page',++$page)->with('item',null)->with('activity', $currentActivityFilter)->with('location', $currentLocationFilter); ?>">
					<?php _e('Load more members', 'hegspots'); ?>
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>

</div>
