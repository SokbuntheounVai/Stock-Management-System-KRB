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

    public function update($id, Request $request){

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
                $request->session()->flash('success','Data has been Saved!');
                return redirect('users/create');
            }else{
                $request->session()->flash('error','Fail to save data!');
                return redirect('users/create');
            }     
    }

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
