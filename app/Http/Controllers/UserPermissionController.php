<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Hash;
use File;
use Session;
use App\User;
use App\Role;
use App\Articles;
use App\Tags;
use App\Icon;
use App\Categories;

class UserPermissionController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Users & Permissions',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'users_a' => User::all(),
            'roles' => Role::all(),
            'users_p' => User::where('status',1)->get(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $users = User::where('id','=',$request->search)
                    ->Orwhere('username','LIKE','%'.$request->search.'%')
                    ->Orwhere('email','LIKE','%'.$request->search.'%')
                    ->Orwhere('phone','LIKE','%'.$request->search.'%')
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }elseif($request->has('filter')){
                $users = User::where('role_id','=',$request->filter)
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('filter',$request->filter);
            }else
                $users = User::orderby('id','desc')
                    ->paginate(6);
                return view('backend.pages.user_permission.index',$data, compact('users'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New User',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'roles' => Role::all(),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.user_permission.user-create',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
              'first_name' => 'required|max:50|unique:users',
              'last_name'  => 'required|max:50|unique:users',
              'email'  => 'required|email|unique:users',
              'phone'  => 'required|numeric|unique:users',
              'username'  => 'required|min:3|max:14|unique:users',
              'password'  => 'required|min:6|max:14',
              'confirm_password'  => 'required|same:password',
              'display_name'  => 'required|unique:users',
              'role_id'  => 'required',
              'profile'  => 'required',
              'status' => 'boolean',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                $users = new User();
                $users->first_name = $request->first_name;
                $users->last_name = $request->last_name;
                $users->email = $request->email;
                $users->phone = $request->phone;
                $users->username = $request->username;
                $users->password = Hash::make($request->password);
                $users->role_id = $request->role_id;
                $users->display_name = $request->display_name;
                $users->online = 0;
                $image = $request->profile;
                $extension = $image->getClientOriginalExtension();
                $filename = str_random(12).".{$extension}";
                File::move($image,public_path().'/images/profiles/'.$filename);
                $users->profile = $filename;
                if($request->status !=null){
                  $users->status = $request->status;
                }
                else{
                  $users->status = 0;
                }
                $users->save();
                Session::flash('Success','New User has been created..!');
                return redirect()->route('UserPermissionIndex');
            }else{
                return redirect()->route('UserPermissionIndex');
            }  
        }else
            return redirect()->route('HomePage');
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                $users = User::find($id);
                if($users->profile){
                    File::delete(public_path().'/images/profiles/'.$users->profile);
                }
                $users->delete();
                Session::flash('Success','User has been delete..!');
                return redirect()->route('UserPermissionIndex');  
            }else{
                return redirect()->route('UserPermissionIndex'); 
            }
        }else{
            return redirect()->route('HomePage');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit User',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'users' => User::findOrFail($id),
            'roles' => Role::all(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                return view('backend.pages.user_permission.user-edit',$data); 
            }else{
                return view('backend.pages.user_permission.index',$data); 
            } 
        }else{
            return redirect()->route('HomePage');
        }
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $users = User::find($id);
        $this->validate($request,[
            'first_name' => 'required|max:50|unique:users,first_name,'.$users->id.'id',
            'last_name' => 'required|max:50|unique:users,last_name,'.$users->id.'id',
            'email' => 'required|email|unique:users,email,'.$users->id.'id',
            'phone' => 'required|numeric|unique:users,phone,'.$users->id.'id',
            'role_id'  => 'required',
            'display_name'  => 'required|unique:users,display_name,'.$users->id.'id',
            'status' => 'boolean',

        ]);
        if(Auth::user()->role_id == 1){
            $users->first_name = $request->first_name;
            $users->last_name = $request->last_name;
            $users->email = $request->email;
            $users->display_name = $request->display_name;
            $users->phone = $request->phone;
            $users->role_id = $request->role_id;
            $users->updated_at = date("Y-m-d G:i:s");
            if($request->status !=null){
              $users->status = $request->status;
            }
            else{
              $users->status = 0;
            }
            $users->update();
            Session::flash('Success','Users has been updated..!');
            return redirect()->route('UserPermissionIndex'); 
        }else{
            return redirect()->route('UserPermissionIndex'); 
        }
    }
    public function unpublish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
            $users = User::find($id);
            $users->status = 0;
            $users->save();
            return redirect()->route('UserPermissionIndex'); 
            }
            else{
               return redirect()->route('UserPermissionIndex'); 
            }
        }
        else
            return redirect()->route('HomePage');
    }
    public function publish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
            $users = User::find($id);
            $users->status = 1;
            $users->save();
            return redirect()->route('UserPermissionIndex'); 
            }
            else{
               return redirect()->route('UserPermissionIndex'); 
            }
        }
        else
            return redirect()->route('HomePage');
    }
    public function change_password(Request $request, $id){
        $users = User::find($id);
        $data = [
            'title' => 'Change Passord',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                if(Auth::user()->role_id != $users->role_id){
                    return view('backend.pages.user_permission.change-password' ,$data, compact('users'));
                }elseif(Auth::user()->id == $users->id){
                    return view('backend.pages.user_permission.change-password',$data, compact('users'));
                }else{
                    return redirect()->route('UserPermissionIndex');
                }
            }else{
                return redirect()->route('UserPermissionIndex');
            }
        }else{
            return redirect()->route('HomePage');
        }
    }
    public function change_password_update(Request $request, $id){
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
                    $users->pass_last_changed = date("Y-m-d G:i:s");
                    $users->update();
                    Session::flash('Success','Password has been updated..!');
                    return redirect()->route('UserPermissionIndex');
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
    public function view(Request $request, $id){
        $data = [
            'title' => 'User Detail',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'users' => User::find($id),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                return view('backend.pages.user_permission.view',$data);
            }else{
                return redirect()->route('UserPermissionIndex');
            }
        }
        else
            return redirect()->route('HomePage');
    }
    public function activity(Request $request, $id){
        $data = [
            'title' => 'User Activity',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'users' => User::find($id),
            'articles' => Articles::where('user_id','=',$id)->orderby('id','desc')->paginate(7),
            'articles_a' => Articles::where('user_id','=',$id)->get(),
            'categories' => Categories::where('created_by','=',$id)->orderby('id','desc')->paginate(7),
            'categories_a' => Categories::where('created_by','=',$id)->get(),
            'tags' => Tags::where('created_by','=',$id)->orderby('id','desc')->paginate(7),
            'tags_a' => Tags::where('created_by','=',$id)->get(),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.user_permission.activity',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function roles(){
        $data = [
            'title' => 'User Roles',
            'menu' => 'user',
            'dropdown' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
            'roles' => Role::all(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.user_permission.role-index',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function roles_create(){
        $data = [
            'title' => 'Add New Roles',
            'menu' => 'user',
            'dropdown' => '',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.user_permission.role-create',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function roles_store(Request $request){
        //dd($request->all());
        $this->validate($request,[
              'name' => 'required|unique:roles',
              'description'  => 'required|unique:roles',
              'priority'  => 'required|numeric',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
                $role = new Role();
                $role->name = $request->name;
                $role->description = $request->description;
                $role->priority = $request->priority;
                $role->save();
                Session::flash('Success','New Role has been created..!');
                return redirect()->route('RolesIndex');
            }else{
                return redirect()->route('RolesIndex');
            }
        }else
            return redirect()->route('HomePage');
    }
    public function roles_view(Request $request, $id){
        $data = [
            'title' => 'Roles',
            'menu' => 'user',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown' => '',
            'dropdown1' => '',
            'dropdown2' => '',
            'roles' => Role::find($id),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
            return view('backend.pages.user_permission.role-view',$data);
            }else{
                return redirect()->route('RolesIndex');
            }
        }else
            return redirect()->route('HomePage');
    }
    public function roles_edit($id){
        $data = [
        'title' => 'Update Role',
        'menu' => 'user',
        'favicons' => Icon::orderby('id','desc')->paginate(1),
        'dropdown' => '',
        'dropdown1' => '',
        'dropdown2' => '',
        'roles' => Role::findOrFail($id),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if(Auth::user()->role_id == 1){
            return view('backend.pages.user_permission.role-edit',$data);
            }else{
                return redirect()->route('RolesIndex');
            }  
        }
        else
            return redirect()->route('HomePage');
    }
    public function roles_update(Request $request,$id){
        //dd($request->all());
        $roles = Role::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:roles,name,'.$roles->id.'id',
            'description' => 'required|unique:roles,name,'.$roles->id.'id',
            'priority' => 'required|numeric',
        ]);
        $roles->name = $request->name;
        $roles->description = $request->description;
        $roles->priority = $request->priority;
        $roles->update();
        Session::flash('Success','Role has been updated..!');
        return redirect()->route('RolesIndex');
    }
    public function destroyimage(Request $request){
        if($request->ajax()){
            $users = User::find($request->key);
            File::delete(public_path().'/images/profiles/'.$users->profile);
            $users->profile = null;
            $users->save();
            echo 1;
        }  
    }
    public function uploadimage(Request $request,$id){
        if($request->hasFile('profile')){
            $users = User::find($id);
            $image = $request->file('profile');
            if(File::move($image,public_path().'/images/profiles/'.$image->getClientOriginalName())){
                $users->profile = $image->getClientOriginalName();
                $users->save();
                echo 1;
            }
        }
        echo 0;
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
