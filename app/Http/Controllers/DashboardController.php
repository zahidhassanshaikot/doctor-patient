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
        $doctors    = User::orderBy('id','ASC')->where('doctor',1)->count();
        $patients   = User::orderBy('id','ASC')->where('doctor',0)->where('admin',0)->count();
        return view('back-end.dashboard.dashboard',compact('patients','doctors'));
    }


}
