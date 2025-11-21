<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieManagementController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('_admin.categories.index', compact('categories'));
    }
}
