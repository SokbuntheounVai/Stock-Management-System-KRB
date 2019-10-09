<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,DB;
class UserController extends Controller
{
    public function index(Request $r){
        $i = $data['users'] = DB::table('users')
        ->where('active','1')
        ->orderBy('id','desc')
        ->paginate(22);
        if($i){
            $r->session()->flash('have','Data has been removed!');
            return view('pages.users.index',$data);
        }else{
            $r->session()->flash('null','Data has been removed!');
            return view('pages.users.index');
        }
        
    }

    public function create(){
        return view('pages.users.create');
    }

    public function delete($id, Request $r){
        
        $i = DB::table('users')->where('id',$id)->update(['active'=>0]);
        if($i){
            $r->session()->flash('success','Data has been removed!');
            return redirect('users');
        }else{
            $r->session()->flash('error','Data has been removed!');
            return redirect('users');
        }
    }

    public function trash(){
        $data['users'] = DB::table('users')
        ->where('active','0')
        ->orderBy('id','desc')
        ->paginate(22);
        return view('pages.users.trash',$data);
    }

    public function trashRestore($id, Request $r){
        $i = DB::table('users')->where('id',$id)->update(['active'=>1]);
        if($i){
            $r->session()->flash('success','Data has been removed!');
            return redirect('users/trash');
        }else{
            $r->session()->flash('error','Data has been removed!');
            return redirect('pages.users.trash');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
