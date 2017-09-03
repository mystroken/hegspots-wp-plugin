<?php 
use \Vitaminate\Routing\URL; ?>

<div class="wrap">

	<h1><?php _e('Settings', 'hegspots'); ?></h1>

	<!-- <h2 class="nav-tab-wrapper">
		<a href="<?php echo URL::to('options_index'); ?>" class="nav-tab">
		<?php _e('Options', 'hegspots'); ?>
		</a>
		<a href="<?php echo URL::to('options_page_settings'); ?>" class="nav-tab nav-tab-active">
			<?php _e('Pages', 'hegspots'); ?>
		</a>
	</h2> -->

	<form action="<?php echo URL::to('options_index'); ?>" method="post" id="hegspots-page-form">
		
		<h3><?php _e('Directories', 'hegspots'); ?></h3>

		<p>
			<?php _e('Choose a Wordpress page to associate with each directory of Heg Spots components.', 'hegspots'); ?>
		</p>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="hegspots_pages[places]"><?php _e('Places', 'hegspots'); ?></label>
					</th>
					<td>	
						<select name="hegspots_pages[places]" id="hegspots_pages[places]">
							<option value=""><?php _e('None', 'hegspots'); ?></option>
							<?php foreach($wpPages as $wpPage): ?>
							<option class="level-0" value="<?php echo $wpPage->ID; ?>"
							<?php if(!empty($pluginPages['places']) && $pluginPages['places'] == $wpPage->ID ): ?>
								selected
							<?php endif; ?>
							>
								<?php echo $wpPage->post_title; ?>
							</option>
							<?php endforeach; ?>
						</select>

						<?php if(!empty($pluginPages['places']) && intval($pluginPages['places'])>0 ): ?>
							<a href="<?php echo get_option('siteurl') . '?p=' . intval($pluginPages['places']); ?>" class="button-secondary" target="_bp"><?php _e('Display', 'hegspots') ?></a>		
						<?php endif; ?>					
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="hegspots_pages[members]"><?php _e('Members', 'hegspots') ?></label>
					</th>
					<td>						
						<select name="hegspots_pages[members]" id="hegspots_pages[members]">
							<option value=""><?php _e('None', 'hegspots'); ?></option>
							<?php foreach($wpPages as $wpPage): ?>
							<option class="level-0" value="<?php echo $wpPage->ID; ?>"
							<?php if(!empty($pluginPages['members']) && $pluginPages['members'] == $wpPage->ID ): ?>
								selected
							<?php endif; ?>
							>
								<?php echo $wpPage->post_title; ?>
							</option>
							<?php endforeach; ?>
						</select>

						<?php if(!empty($pluginPages['members']) && intval($pluginPages['members'])>0 ): ?>
							<a href="<?php echo get_option('siteurl') . '?p=' . intval($pluginPages['members']); ?>" class="button-secondary" target="_bp"><?php _e('Display', 'hegspots') ?></a>		
						<?php endif; ?>				
					</td>
				</tr>
			</tbody>
		</table>
				
		<p class="submit clear">
			<input class="button-primary" type="submit" name="hegspots-pages-submit" id="hegspots-pages-submit" value="<?php _e('Save Settings', 'hegspots'); ?>">
		</p>
	</form>


</div><!-- /. wrap -->