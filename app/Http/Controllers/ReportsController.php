<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Icon;

class ReportsController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Reports & Issuses',
            'menu' => 'report',
            'dropdown' => '',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.reports.index',$data);
        }
        else
            return redirect()->route('HomePage');
    }
}
