<?php
use \Vitaminate\Routing\URL;

if( !function_exists('asset') )
{
	function asset($resource)
	{
		return plugins_url('assets/' . $resource, app('path'));
	}
}

if( !function_exists('config') )
{
	function config($name)
	{
		$config = require __DIR__  . '/../config/config.php';
		return $config[$name];
	}
}

if( !function_exists('excerpt') )
{
	function excerpt($text)
	{
		return substr($text, 0, 137);
	}
}


if( !function_exists('display_recommendators') )
{
	function display_recommendators($recommendators)
	{
		$index = 0;
		$leftItems = sizeof($recommendators);
		$itemsToDisplay = 3;
	?>
		<div class="place-recommendations">
			<span><?php _e('Recommended by', 'hegspots'); ?></span>&nbsp;&nbsp;
			<?php foreach( $recommendators as $member ): ++$index; --$leftItems; ?>

			<?php if( $index <= $itemsToDisplay ): ?>
				<a href="<?php echo URL::to('front_members')->with('item',$member->ID)->with('type',null); ?>" title="<?php echo $member->name; ?>">
					<img src="<?php echo $member->profile->photo; ?>" class="pic pic__thumb pic--rounded" alt="<?php _e('by member', 'hegspots'); ?> <?php echo $member->name; ?>">
				</a>
			<?php elseif( $index > $itemsToDisplay AND $leftItems > 0 ) : ?>
				<a href="javascript:void(0);">
					<span class="pic pic__thumb pic--rounded"><?php echo '+' . $leftItems; ?></span>
				</a>
			<?php
				break;
			endif; ?>

			<?php endforeach; ?>
		</div>
	<?php
	}
}
