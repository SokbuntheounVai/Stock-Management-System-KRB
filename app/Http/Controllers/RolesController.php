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

    public function edit($id){
        $data['roles'] = DB::table('roles')->where('id',$id)->get();
        return view('pages.roles.edit',$data);
    }

    public function update(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $data = array(
            'name' => $request->name,
        );
        $i = DB::table('roles')->where('id',$request->id)->update($data);
        if($i){
            $request->session()->flash('u-success','Data has been updated!');
            return redirect('roles');
        }else{
            $request->session()->flash('u-error','Fail to update data!');
            return redirect('roles/edit/'.$request->id);
        }     
    }

    public function save(Request $request){
            
        $validate = $request->validate([
                'name' => 'required|min:3|max:50',
            ]);
    
            $data = array( 'name' => $request->name );
            $i = DB::table('roles')->insert($data);
            if($i){
                $request->session()->flash('c-success','Data has been Saved!');
                return redirect('roles/create');
            }else{
                $request->session()->flash('c-error','Fail to save data!');
                return redirect('roles/create');
            }     
    }


    public function create(){

        $data['roles'] = DB::table('roles')->where('active',1)->get();
        return view('pages.roles.create', $data);
    }

    public function delete($id, Request $r){
        
        $i = DB::table('roles')->where('id',$id)->update(['active'=>0]);
        if($i){
            $r->session()->flash('d-success','Data has been removed!');
            return redirect('roles');
        }else{
            $r->session()->flash('d-error','Data has been removed!');
            return redirect('roles');
        }
    }

    public function trash(){
        $data['roles'] = DB::table('roles')
        ->where('active','0')
        ->orderBy('id','desc')
        ->paginate(22);
        return view('pages.roles.trash',$data);
    }

    public function trashRestore($id, Request $r){
        $i = DB::table('roles')->where('id',$id)->update(['active'=>1]);
        if($i){
            $r->session()->flash('t-success','Data has been restored!');
            return redirect('roles/trash');
        }else{
            $r->session()->flash('t-error','Fail to restore Date!');
            return redirect('pages.roles.trash');
        }
    }
}
