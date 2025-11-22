<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentManagementController extends Controller
{
    public function index()
    {
        return view('_admin.comments.index');
    }
}
