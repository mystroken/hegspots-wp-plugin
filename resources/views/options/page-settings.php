<?php 
use Vitaminate\Routing\URL;
use App\Models\Options; ?>

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
			<?php foreach(Options::$pagesListKeys as $pageKey => $pageValue): ?>
				<tr valign="top">
					<th scope="row">
						<label for="<?php echo Options::$pagesKeyName.'['.$pageKey.']'; ?>"><?php _e(ucfirst($pageKey), 'hegspots'); ?></label>
					</th>
					<td>	
						<select name="<?php echo Options::$pagesKeyName.'['.$pageKey.']'; ?>" id="<?php echo Options::$pagesKeyName.'['.$pageKey.']'; ?>">
							<option value=""><?php _e('None', 'hegspots'); ?></option>
							<?php foreach($wpPages as $wpPage): ?>
							<option class="level-0" value="<?php echo $wpPage->ID; ?>"
							<?php if(!empty($pluginPages[$pageKey]) && $pluginPages[$pageKey] == $wpPage->ID ): ?>
								selected
							<?php endif; ?>
							>
								<?php echo $wpPage->post_title; ?>
							</option>
							<?php endforeach; ?>
						</select>

						<?php if(!empty($pluginPages[$pageKey]) && intval($pluginPages[$pageKey])>0 ): ?>
							<a href="<?php echo get_option('siteurl') . '?p=' . intval($pluginPages[$pageKey]); ?>" class="button-secondary" target="_bp"><?php _e('Display', 'hegspots') ?></a>		
						<?php endif; ?>					
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
				
		<p class="submit clear">
			<input class="button-primary" type="submit" name="hegspots-pages-submit" id="hegspots-pages-submit" value="<?php _e('Save Settings', 'hegspots'); ?>">
		</p>
	</form>


</div><!-- /. wrap -->