<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RolesController extends Controller
{
    public function index(Request $r){
        $i = $data['roles'] = DB::table('roles')
        ->where('roles.active','1')
        ->orderBy('roles.id','asc')
        ->paginate(22);
        if($i){
            $r->session()->flash('have','Data has been removed!');
            return view('pages.roles.index',$data);
        }else{
            $r->session()->flash('null','Data has been removed!');
            return view('pages.roles.index');
        }
        
    }
}
