<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use File;
use Session;
use App\Logo;
use App\Icon;

class LogoIconController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Logo & Favicon',
            'menu' => 'logo',
            'dropdown' => '',
            'dropdown1' => 'menu',
            'dropdown2' => '',
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'favicons' => Icon::orderby('id','desc')->paginate(1),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.logo_icon.index',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function logo(){
        $data = [
            'title' => 'Add New Logo',
            'menu' => 'logo',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown' => '',
            'dropdown1' => 'menu',
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.logo_icon.logo',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function logo_store(Request $request){
        //dd($request->img);
        $this->validate($request,[
              'img'  => 'required',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $logo = new Logo();
            $image = $request->file('img');
            File::move($image,public_path().'/images/logo/'.$image->getClientOriginalName());
            $logo->img = $image->getClientOriginalName();
            $logo->save();
            Session::flash('Success','New Logo has been publish!');
            return redirect()->route('LogoIconIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function favicon(){
        $data = [
            'title' => 'Add New Favicon',
            'menu' => 'logo',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown' => '',
            'dropdown1' => 'menu',
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.logo_icon.favicon',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function favicon_store(Request $request){
        //dd($request->img);
        $this->validate($request,[
              'img'  => 'required',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $favicon = new Icon();
            $image = $request->file('img');
            File::move($image,public_path().'/images/icon/'.$image->getClientOriginalName());
            $favicon->img = $image->getClientOriginalName();
            $favicon->save();
            Session::flash('Success','New Favicon has been publish!');
            return redirect()->route('LogoIconIndex');
        }else
            return redirect()->route('HomePage');
    }
}