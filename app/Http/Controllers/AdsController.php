<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use File;
use Session;
use App\Ads;
use App\Icon;

class AdsController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Ads',
            'menu' => 'ads',
            'dropdown' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => 'menu',
            'dropdown2' => '',
            'ads_a' => Ads::all(),
            'ads_p' => Ads::where('id',1)->get(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $ads = Ads::where('id','=',$request->search)
                    ->Orwhere('name','LIKE','%'.$request->search.'%')
                    ->Orwhere('price','LIKE','%'.$request->search.'%')
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }elseif($request->has('filter0')){
                $ads = Ads::where('page','=',$request->filter0)
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('filter0',$request->filter0);
            }elseif($request->has('filter1')){
                $ads = Ads::where('position','=',$request->filter1)
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('filter1',$request->filter1);
            }else
                $ads = Ads::orderby('id','desc')
                    ->paginate(6);
                return view('backend.pages.ads.index',$data, compact('ads'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New Ads',
            'menu' => 'ads',
            'dropdown' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => 'menu',
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.ads.create',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
              'name' => 'required|unique:ads',
              'url'  => 'required',
              'position'  => 'required',
              'page'  => 'required',
              'size'  => 'required',
              'price'  => 'required|numeric',
              'img'  => 'required',
              'status' => 'boolean',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $ads = new Ads();
            $ads->name = $request->name;
            $ads->url = $request->url;
            $ads->price = $request->price;
            $ads->size = $request->size;
            $ads->page = $request->page;
            $ads->position = $request->position;

            $image = $request->file('img');
            File::move($image,public_path().'/images/ads/'.$image->getClientOriginalName());
            $ads->img = $image->getClientOriginalName();

            if($request->status !=null){
              $ads->status = $request->status;
            }
            else{
              $ads->status = 0;
            }
            $ads->save();
            Session::flash('Success','New Ads has been created..!');
            return redirect()->route('AdsIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function view($id){
        $data = [
            'title' => 'Ads Detail',
            'menu' => 'ads',
            'dropdown' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'ads' => Ads::find($id),
            'dropdown1' => 'menu',
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.ads.view',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Ads',
            'menu' => 'ads',
            'dropdown' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'ads' => Ads::findOrFail($id),
            'dropdown1' => 'menu',
            'dropdown2' => '',
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.ads.edit',$data);
        }
        else
            return redirect()->route('HomePage');
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $ads = Ads::find($id);
        $this->validate($request,[
            'name' => 'required|unique:ads,name,'.$ads->id.'id',
            'url'  => 'required',
            'position'  => 'required',
            'page'  => 'required',
            'size'  => 'required',
            'price'  => 'required|numeric',
            //'img'  => 'required',
            'status' => 'boolean',

        ]);
        $ads->name = $request->name;
        $ads->url = $request->url;
        $ads->price = $request->price;
        $ads->size = $request->size;
        $ads->page = $request->page;
        $ads->position = $request->position;
        $ads->updated_at = date("Y-m-d G:i:s");
        if($request->status !=null){
          $ads->status = $request->status;
        }
        else{
          $ads->status = 0;
        }
        $ads->update();
        Session::flash('Success','Ads has been updated..!');
        return redirect()->route('AdsIndex'); 
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $ads = Ads::find($id);
            if($ads->img){
                File::delete(public_path().'/images/ads/'.$ads->img);
            }
            $ads->delete();
            return redirect()->route('AdsIndex');   
        }
        else
            return redirect()->route('HomePage');
    }
    public function destroyimage(Request $request){
        if($request->ajax()){
            $ads = Ads::find($request->key);
            File::delete(public_path().'/images/ads/'.$ads->img);
            $ads->img = null;
            $ads->save();
            echo 1;
        }  
    }
    public function uploadimage(Request $request,$id){
        if($request->hasFile('img')){
            $ads = Ads::find($id);
            $image = $request->file('img');
            if(File::move($image,public_path().'/images/ads/'.$image->getClientOriginalName())){
                $ads->img = $image->getClientOriginalName();
                $ads->save();
                echo 1;
            }
        }
        echo 0;
    }
}
