<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\MemberListTable;
use Vitaminate\Http\Request;

class MemberController extends Controller
{

    public function index(Request $request)
    {
        $memberListTable = new MemberListTable();
        return $this->render('member.index', [ 'memberListTable' => $memberListTable]);
    }

    /**
     * @param Request $request
     */
    public function initSubRouting(Request $request, $page)
    {
        // Default action
        $this->subRouter->addRoute(
            'member_index',
            ['page' => $page],
            $this,
            'index',
            ['request' => $request]
        );
    }
}