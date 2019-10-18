<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,DB;
class UserController extends Controller
{
    public function edit($id){
        $data['users'] = DB::table('users')->where('id',$id)->get();
        return view('pages.users.edit',$data);
    }

    public function update(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required|min:3|unique:users|max:50',
            'email' => 'required'
        ]);

        $data = array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // 'password' => bcrypt($request->password)
            // 'name' => $request->name,
        );
        if($request->password!=""){
            $request->validate([
                'password' => 'required|min:5'
            ]);
            $data['password'] = bcrypt($request->password);
        }
        if($request->photo){
            $data['photo'] = $request->file('photo')->store('uploads/users', 'custom');
        }
        $i = DB::table('users')->where('id',$request->id)->update($data);
        if($i){
            $request->session()->flash('u-success','Data has been updated!');
            return redirect('users');
        }else{
            $request->session()->flash('u-error','Fail to update data!');
            return redirect('users/edit/'.$request->id);
        }     
    }

    public function save(Request $request){
            
        $validate = $request->validate([
                'name' => 'required|min:3|max:50',
                'username' => 'required|min:3|unique:users|max:50',
                'email' => 'required',
                'password' => 'required|min:5'
            ]);
    
            $data = array(
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
                // 'name' => $request->name,
            );
            if($request->photo){
                $data['photo'] = $request->file('photo')->store('uploads/users', 'custom');
            }
            $i = DB::table('users')->insert($data);
            if($i){
                $request->session()->flash('c-success','Data has been Saved!');
                return redirect('users/create');
            }else{
                $request->session()->flash('c-error','Fail to save data!');
                return redirect('users/create');
            }     
    }

    public function index(Request $r){
        $i = $data['users'] = DB::table('users')
        ->join('roles','users.role_id', 'roles.id')
        ->select('users.*', 'roles.name as r_name')
        ->where('users.active','1')
        ->orderBy('users.id','desc')
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

        $data['roles'] = DB::table('roles')->where('active',1)->get();
        return view('pages.users.create', $data);
    }

    public function delete($id, Request $r){
        
        $i = DB::table('users')->where('id',$id)->update(['active'=>0]);
        if($i){
            $r->session()->flash('d-success','Data has been removed!');
            return redirect('users');
        }else{
            $r->session()->flash('d-error','Data has been removed!');
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
            $r->session()->flash('t-success','Data has been restored!');
            return redirect('users/trash');
        }else{
            $r->session()->flash('t-error','Fail to restore Date!');
            return redirect('pages.users.trash');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
