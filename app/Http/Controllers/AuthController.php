<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\User;
use App\Icon;
use Auth;
use Hash;
use Session;

class AuthController extends Controller
{
    public function getRegister(){
        if(Auth::check()){
            return redirect()->route('UserDashboard'); 
        }
        else
            $data = [
                'title' => 'User Authentication',
                'favicons' => Icon::orderby('id','desc')->paginate(1),
            ];
            return view('authentication.register',$data);
    }
    public function getLogin(){
        if(Auth::check()){
            return redirect()->route('UserDashboard'); 
        }
        else
            $data = [
                'title' => 'User Authentication',
                'favicons' => Icon::orderby('id','desc')->paginate(1),
            ];
            return view('authentication.login',$data);
    }
    public function postLogin(UserLoginRequest $request){
        if (Auth::attempt(['username' => $request->a, 'password' => $request->b, 'status' => 1])) {
        	Session::flash('Success','Signed in successfully!');
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->online = 1;
            $user->update();
            return redirect()->route("UserDashboard");
        }if (Auth::attempt(['email' => $request->a, 'password' => $request->b,'status' => 1])) {
        	Session::flash('Success','Signed in successfully!');
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->online = 1;
            $user->update();
            return redirect()->route("UserDashboard");
        }else {
        	Session::flash('Danger','Something went wrong. Please try login again!');
            return redirect()->route("getUserLogin");
        }
    }
    public function postRegister(UserRegisterRequest $request){
    	$user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->role_id = 5;
        $user->status = 1;
        $user->online = 0;
		$user->save();
        Session::flash('Success','New user has been registered. Please login!');
		return redirect()->route('getUserLogin');
    }
    public function getLogout() {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->last_logged = date("Y-m-d G:i:s");
        $user->online = 0;
        $user->update();
        Auth::logout();
        return redirect()->route("HomePage");
    }
}
