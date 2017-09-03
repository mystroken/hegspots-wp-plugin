<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\MemberListTable;
use Vitaminate\Http\Request;
use App\Support\Slugger;
use Vitaminate\Routing\URL;
use App\Models\Member;
use App\Models\Profile;
use App\Models\Location;

class MemberController extends Controller
{

    public function index(Request $request)
    {
        if( !empty($data = $request->request->all()) )
        {

            $slugger = new Slugger;
            $member = new Member;


            // Location
            $location = Location::createFromRequest($request);


            var_dump('ID: '      .  $location->ID);
            var_dump('Slug: '    .  $location->slug);
            var_dump('Town: '    .  $location->town);
            var_dump('Country: ' .  $location->country);
 
        
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
        

            // Member
            $member->name      = $request->request->get('name');
            $member->slug      = $slugger->slugify($member->name);
            $member->instagram = $request->request->get('instagram');
            

            // Link models (Relationship)
            $member->profile()->associate($profile);
            $member->location()->associate($location);

            var_dump($member->name );


            // Save the member
            $member->save(); 
        }

        $memberListTable = new MemberListTable();
        return $this->render('member.index', [ 'memberListTable' => $memberListTable]);
    }

    public function createMember(Request $request)
    {
        return $this->render('member.create-member');
    }
}