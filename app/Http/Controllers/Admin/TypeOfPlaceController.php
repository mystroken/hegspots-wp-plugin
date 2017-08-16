<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use Vitaminate\Http\Request;
use App\Models\TypePlace;
use App\Support\Slugger;

class TypeOfPlaceController extends Controller
{

    public function index(Request $request)
    {
        
        if( !empty($request->request->all()) )
        {
            $slugger = new Slugger;
            $typeOfPlace = new TypePlace;
            $typeOfPlace->name = $request->request->get('name');
            $typeOfPlace->slug = $slugger->slugify($typeOfPlace->name);
            $typeOfPlace->photo = $request->request->get('photo');
            $typeOfPlace->description = $request->request->get('description');
            $typeOfPlace->save();
        }

        $typesOfPlace = TypePlace::all();
        return $this->render('typeofplace.index', array( 'typesOfPlace' => $typesOfPlace ));
    }

    public function delete(Request $request)
    {
        if( !empty($id = (int) $request->query->get('id')) )
        {
            $typeOfPlace = TypePlace::find($id);
            if(null !== $typeOfPlace) $typeOfPlace->delete();
        }

        $typesOfPlace = TypePlace::all();
        return $this->render('typeofplace.index', array( 'typesOfPlace' => $typesOfPlace ));
    }

    /**
     * @param Request $request
     */
    public function initSubRouting(Request $request, $page)
    {
        
        // Delete action
        $this->subRouter->addRoute(
            'type_of_place_delete',
            [
                'page' => $page,
                'action' => 'delete',
            ],
            $this,
            'delete',
            ['request' => $request]
        );

        
        // Default action
        $this->subRouter->addRoute(
            'type_of_place_index',
            [
                'page' => $page,
            ],
            $this,
            'index',
            ['request' => $request]
        );
    }
}