<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Routing\SubRoute;
use App\Http\Routing\SubRouter;
use App\Models\Activity;
use Vitaminate\Http\Request;
use App\Support\Slugger;

class ActivityController extends Controller
{
	public function index(Request $request)
	{
        if( !empty($data = $request->request->all()) )
        {
            $slugger = new Slugger;
            $activity = new Activity;
            $activity->name = $request->request->get('name');
            $activity->slug = $slugger->slugify($activity->name);
            $activity->save();
        }

	    $activities = Activity::all();
		$this->render('activity.index', array('activities' => $activities));
	}

	public function delete(Request $request)
    {
        if( !empty($id = (int) $request->query->get('id')) )
        {
            $activity = Activity::find($id);
            if(null !== $activity) $activity->delete();
        }

        $activities = Activity::all();
        $this->render('activity.index', array('activities' => $activities));
    }
}