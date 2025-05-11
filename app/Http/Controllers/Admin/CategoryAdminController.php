<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryAdminController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.categories.categories', compact('categories'));
    }

    public function edit()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function changeSort()
    {

    }
}
