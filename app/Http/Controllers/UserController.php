<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,DB;
class UserController extends Controller
{
    public function index(){
        $data['users'] = DB::table('users')
        ->orderBy('id','desc')
        ->paginate(22);
        return view('pages.users.index',$data);
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
