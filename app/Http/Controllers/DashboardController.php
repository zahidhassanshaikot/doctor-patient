<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Disease;
use App\Models\Treatment;
use App\Models\User;
use App\Models\Message;
use Image;
use Validator;
use File;

class DashboardController extends Controller
{
    public function index()
    {

        return view('back-end.dashboard.dashboard');
    }

    
}
