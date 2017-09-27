<?php 
use WordPruss\Notices\Notify; 


Notify::success('Dashboard page successfully displayed!');
Notify::hook();
?>
<div class="wrap about-wrap patterns-overview-wrap">
	<h1>
		<?php _e('Welcome to Heg Spots', 'hegspots'); ?>
	</h1>

	<div class="about-text">
		<?php 
			_e('Your  WordPress Extension to allow you to pusblish some recommended places from some users.', 'hegspots');
		?>
	</div>

	<div class="welcome-panel">
		<div class="welcome-panel-content">
			<h2>
				<?php _e('Overview', 'hegspots'); ?>
			</h2>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<h3>
						<?php _e('Shortcut', 'hegspots'); ?>
					</h3>
					<a class="button button-primary button-hero" href="<?php echo \Vitaminate\Routing\URL::to('place_create'); ?>">
						<?php _e('Add a new place', 'hegspots'); ?>
					</a>
					<p>or, <a href="<?php echo \Vitaminate\Routing\URL::to('member_create'); ?>"><?php _e('Create a new member', 'hegspots'); ?></a></p>
				</div>
				<div class="welcome-panel-column">
					<h3>Column Title</h3>
					<ul>
						<li><a href="#" class="welcome-icon welcome-write-blog">Item One</a></li>
						<li><a href="#" class="welcome-icon welcome-add-page">Item Two</a></li>
						<li><a href="#" class="welcome-icon welcome-view-site">Item Three</a></li>
					</ul>
				</div>
				<div class="welcome-panel-column welcome-panel-last">
					<h3>Column Title</h3>
					<ul>
						<li>
							<div class="welcome-icon welcome-widgets-menus">
								Manage <a href="#">Item One</a>
							</div>
						</li>
						<li><a href="#" class="welcome-icon welcome-comments">Item Two</a></li>
						<li><a href="#" class="welcome-icon welcome-learn-more">Item Three</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	
</div><!-- /.wrap -->