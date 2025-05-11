<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Role;
use Illuminate\View\View;

class IndexAdminController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id')->paginate(15);

        return view('admin.index', compact('pages'));
    }
}
