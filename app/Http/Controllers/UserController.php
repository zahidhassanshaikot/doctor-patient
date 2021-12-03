<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Message;
use Validator;
use Auth;
use DB;

class UserController extends Controller
{
    public function userList(){
        $users = User::orderBy('id','ASC')->get();
        return view('back-end.users',compact('users'));
    }
    public function notApprove($id){
        $user = User::FindOrFail($id);
        $user->approve = 0;
        $user->save();
        return \redirect()->back()->with('success','Successfully updated.');
    }
    public function approve($id){
        $user = User::FindOrFail($id);
        $user->approve = 1;
        $user->save();
        return \redirect()->back()->with('success','Successfully updated.');
    }
}
