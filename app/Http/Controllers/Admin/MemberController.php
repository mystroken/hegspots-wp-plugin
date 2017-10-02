<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\MemberListTable;
use Vitaminate\Http\Request;
use WeDevs\ORM\Eloquent\Facades\DB;
use App\Support\Slugger;
use Vitaminate\Routing\URL;
use Vitaminate\Routing\Redirect;
use App\Models\Member;
use App\Models\Activity;
use App\Models\Profile;
use App\Models\Location;

class MemberController extends Controller
{

    public function index(Request $request)
    {
        $memberListTable = new MemberListTable();
        return $this->render('member.index', [ 'memberListTable' => $memberListTable]);
    }

    public function createMember(Request $request)
    {
    	$member = new Member;
		$this->createOrUpdate($member, $request);
    }

    public function editMember(Request $request)
    {
    	$memberID = intval($request->query->get('item'));
		$member = Member::find($memberID);

		if( !is_null($member) )
		{
			$this->createOrUpdate($member, $request);
		}
		else
		{
			Redirect::to(URL::to('member_index'));
		}
    }


    protected function createOrUpdate(Member $member, Request $request)
    {
    	if( !empty($data = $request->request->all()) )
    	{
    	    $slugger = new Slugger;

    	    // Location
    	    $location = Location::createFromRequest($request);

    	    // Profile
    	    $profile = Profile::create(
    	        [
    	            'photo'      => $request->request->get('photo'),
    	            'cover'      => $request->request->get('cover'),
    	            'about'      => $request->request->get('about'),
    	            'watch'      => $request->request->get('watch'),
    	            'bag'        => $request->request->get('bag'),
    	            'book'       => $request->request->get('book'),
    	            'grooming'   => $request->request->get('grooming'),
    	            'brand'      => $request->request->get('brand'),
    	            'style_icon' => $request->request->get('style-icon'),
    	        ]
    	    );

    	    // Recommendators
			$memberActivities = (array) $request->request->get('activities');

    	    // Member
    	    $member->name      = $request->request->get('name');
    	    $member->slug      = $slugger->slugify($member->name);
    	    $member->instagram = $request->request->get('instagram');

    	    // Link models (Relationship)
    	    $member->profile()->associate($profile);
    	    $member->location()->associate($location);

    	    // Save the member
    	    if( $member->ID > 0 )
    	    {
				// Updating
				$member->activities()->sync($memberActivities);
    	    	$member->update();
	    		Redirect::to(URL::to('member_index'));
    	    }
    	    else
    	    {
    	    	// Saving
    	    	if( $member->save() )
				{
					$member->activities()->attach($memberActivities);
    	    		Redirect::to(URL::to('member_index'));
				}
    	    }
    	}

    	$activities = Activity::orderBy('name','asc')->get();

    	return $this->render('member.create-member',
    		[
    			'member' => $member,
    			'activities' => $activities,
    		]
    	);
    }
}
