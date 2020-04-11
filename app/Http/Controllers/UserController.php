<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;   
use Session;   
use Hash;   
use App\User;   
use App\Role;   
use App\Icon;   

class UserController extends Controller
{
    public function index(){    
        $data = [
            'title' => 'Welcome',
            'menu' => 'home',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.dashboard',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function profile(){
        $data = [
            'title' => 'Account Setting',
            'menu' => 'account',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'users' => User::find(Auth::user()->id),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.setting.user',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function system(){
        $data = [
            'title' => 'System Setting',
            'menu' => 'system',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.setting.system',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function profile_edit($id){
        $users = User::findOrFail($id);
        $data = [
            'title' => 'Edit Profile',
            'menu' => 'account',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'roles' => Role::all(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->id == $users->id){
                return view('backend.pages.setting.edit',$data, compact('users')); 
            }else{
                return redirect()->route('AccountSetting'); 
            } 
        }else{
            return redirect()->route('HomePage');
        }
    }
    public function profile_update(Request $request,$id){
        //dd($request->all());
        $users = User::find($id);
        $this->validate($request,[
            'first_name' => 'required|max:50|unique:users,first_name,'.$users->id.'id',
            'last_name' => 'required|max:50|unique:users,last_name,'.$users->id.'id',
            'email' => 'required|email|unique:users,email,'.$users->id.'id',
            'phone' => 'required|numeric|unique:users,phone,'.$users->id.'id',
            //'img'  => 'required',
            'status' => 'boolean',

        ]);
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->updated_at = date("Y-m-d G:i:s");
        if($request->status !=null){
          $users->status = $request->status;
        }
        else{
          $users->status = 0;
        }
        $users->update();
        Session::flash('Success','Profile has been updated..!');
        return redirect()->route('AccountSetting'); 
    }
    public function profile_password_edit(Request $request, $id){
        $users = User::find($id);
        $data = [
            'title' => 'Change Passord',
            'menu' => 'account',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->id == $users->id){
                return view('backend.pages.setting.change-password' ,$data, compact('users'));
            }else{
                return redirect()->route('AccountSetting');
            }
        }else{
            return redirect()->route('HomePage');
        }
    }
    public function profile_password_update(Request $request, $id){
        $users = User::find($id);
        if(Hash::check($request->current_password, $users->password)){
                $this->validate($request,[
                'new_password'  => 'required|min:6|max:14',
                'confirm_password'  => 'required|same:new_password',
                ]);
                if(Hash::check($request->new_password, $users->password)){
                    Session::flash('Warning','New Password can not the same Current Passord!');
                    return redirect()->back();
                }else{
                    $users->password = Hash::make($request->new_password);
                    $users->updated_at = date("Y-m-d G:i:s");
                    $users->update();
                    Session::flash('Success','Password has been updated..!');
                    return redirect()->route('AccountSetting');
                }
        }else{
            if($request->current_password == null){
                $this->validate($request,[
                'current_password'  => 'required',
                'new_password'  => 'required|min:6|max:14',
                'confirm_password'  => 'required|same:password',
                ]);
            }else{
            Session::flash('Warning','Current password is incorrect!');
            return redirect()->back();
            }
            return redirect()->back();
        }
    }
}
