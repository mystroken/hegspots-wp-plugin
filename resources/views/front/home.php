<?php
use \Vitaminate\Routing\URL;
use App\Models\Member;
use App\Models\Place;  ?>

<div class="hegspots__wrapper">

	<header class="heading">
		<h1 class="heading__title"><?php _e('The HEG Spots', 'hegspots'); ?></h1>
		<div class="heading__subtitle__top"><?php _e('The Highly Educated Gentlemen\'s spots', 'hegspots'); ?></div>
	</header>

<?php if( $randomPlace ): ?>
	<div class="card card--large card--bordered">
	    <a class="card__image" href="<?php echo URL::to('front_places')->with('item',$randomPlace->ID); ?>">
	    	<img src="<?php echo $randomPlace->photo; ?>" alt="<?php echo $randomPlace->name; ?>">
	    </a><!-- ./card__image -->
	    <div class="card__content card__content--centered">
	    	<h4 class="card__subtitle"><?php echo $randomPlace->type->name; ?></h4>
	    	<h3 class="card__title">
	    		<a href="<?php echo URL::to('front_places')->with('item',$randomPlace->ID); ?>">
	    			<?php echo $randomPlace->name; ?>
	    		</a>
	    	</h3>
	    	<div class="card__subtitle"><?php echo $randomPlace->location; ?></div>
	        <div class="place-recommendations">
	        	<span><?php _e('Recommended by', 'hegspots'); ?></span>&nbsp;&nbsp;
	        	<?php foreach( $randomPlace->recommandators as $member ): ?>
	        		<a href="<?php echo URL::to('front_members')->with('item',$member->ID)->with('type',null); ?>" title="<?php echo $member->name; ?>">
	        			<img src="<?php echo $member->profile->photo; ?>" class="pic pic__thumb pic--rounded" alt="<?php _e('by member', 'hegspots'); ?> <?php echo $member->name; ?>">
	        		</a>
	        	<?php endforeach; ?>
	        </div>
	    </div><!-- ./card__content -->
	</div><!-- ./card -->
<?php endif; ?>

	<section class="section section--highlighted">
		<header class="section__title">
			<h2>
				<?php _e('Explore members and recommendations', 'hegspots'); ?>
			</h2>
		</header>
		<div class="section__content">
			<div class="explore-block">
				<a href="<?php echo URL::to('front_members'); ?>" class="explore-nav">
					<img src="<?php echo asset('img/members-icon.png'); ?>" alt="<?php _e('Members', 'hegspots'); ?>">
					<span><?php _e('Members', 'hegspots'); ?> (<?php echo $membersNum; ?>)</span>
				</a>
			<?php foreach($placeTypes as $type): ?>
				<a href="<?php echo URL::to('front_places')->with('type',$type->ID)->with('item',null)->with('location',null); ?>" class="explore-nav">
					<img src="<?php echo $type->photo; ?>" alt="<?php echo $type->name; ?>">
					<span><?php echo ucfirst($type->name); ?> (<?php echo Place::where('type_place_id', $type->ID)->count(); ?>)</span>
				</a>
			<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<header class="section__title">
			<h2>
				<?php _e('Latest Recommendations', 'hegspots'); ?>
			</h2>
		</header>
		<div class="section__content">
		<?php if( sizeof($latestPlaces) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($latestPlaces as $place ): ?>
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
    		        		<a href="<?php echo URL::to('front_members')->with('item',$member->ID)->with('type',null); ?>" title="<?php echo $member->name; ?>">
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
		<footer class="section__footer">
			<a href="<?php echo URL::to('front_places')->with(['type' => null, 'item' => null]); ?>">
				<?php _e('View all places', 'hegspots'); ?>
			</a>
		</footer>
	</section>

	<section class="section">
		<header class="section__title">
			<h2>
				<?php _e('HEG Members', 'hegspots'); ?>
			</h2>
		</header>
		<div class="section__content">
		<?php if( sizeof($latestMembers) > 0 ): ?>
			<div class="grid-container">
			<?php foreach($latestMembers as $member ): ?>
				<div class="card card--bordered">
				    <a class="card__image" href="<?php echo URL::to('front_members')->with('item', $member->ID); ?>">
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
		<footer class="section__footer">
			<a href="<?php echo URL::to('front_members')->with('item',null); ?>">
				<?php _e('View all members', 'hegspots'); ?>
			</a>
		</footer>
	</section>

</div>
