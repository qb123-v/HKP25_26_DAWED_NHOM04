<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieManagementController extends Controller
{
    public function index()
    {
        return view('_admin.categories.index');
    }

}
