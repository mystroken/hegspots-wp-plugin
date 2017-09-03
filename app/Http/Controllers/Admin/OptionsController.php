<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Models\Options;
use Vitaminate\Http\Request;
use \Vitaminate\View\View;
use \WeDevs\ORM\WP\Post;

class OptionsController extends Controller
{
	public function index(Request $request)
	{
        if( !empty($request->request->all()) )
        {
            Options::setPages($request->request->get('hegspots_pages'));
        }

        $wpPages = Post::where('post_type', '=', 'page')->get();
        $pluginPages = Options::getPages();

        return $this->render('options.page-settings', [
            'wpPages' => $wpPages,
            'pluginPages' => $pluginPages
        ]);
	}

	/**
	 * Set the front end pages of the plugin
	 *
	 * @param Request $request
	 */
	public function pageSetting(Request $request)
	{
		if( !empty($request->request->all()) )
        {
            Options::setPages($request->request->get('hegspots_pages'));
        }

		$wpPages = Post::where('post_type', '=', 'page')->get();
		$pluginPages = Options::getPages();

		return $this->render('options.page-settings', [
			'wpPages' => $wpPages,
			'pluginPages' => $pluginPages
		]);
	}
}