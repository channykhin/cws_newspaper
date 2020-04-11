<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tags;
use App\Icon;
use Auth;
use Session;

class TagsController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Tags',
            'menu' => 'tag',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
            'tags_a' => Tags::all(),
            'tags_p' => Tags::where('status','=',1)->get(),
        ];if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $tags = Tags::where('id','=',$request->search)
                    ->Orwhere('name','LIKE','%'.$request->search.'%')
                    ->Orwhere('slug','LIKE','%'.$request->search.'%')
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }else
                $tags = Tags::orderby('id','desc')
                    ->paginate(6);
                return view('backend.pages.tags.index',$data, compact('tags'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New Tags',
            'menu' => 'tag',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.tags.create',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        $this->validate($request,[
              'name' => 'required|max:50|unique:tags',
              'slug'  => 'required|max:50|unique:tags',
              'status' => 'boolean',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $tags = new Tags();
            $tags->name = $request->name;
            $tags->slug = str_slug($request->slug);
            if($request->status !=null){
              $tags->status = $request->status;
            }
            else{
              $tags->status = 0;
            }
            $tags->created_by = Auth::user()->id;
            $tags->save();
            Session::flash('Success','New Tags has been created..!');
            return redirect()->route('TagsIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function unpublish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $tags = Tags::find($id);
            $tags->status = 0;
            $tags->save();
            return redirect()->route('TagsIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function publish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $tags = Tags::find($id);
            $tags->status = 1;
            $tags->save();
            return redirect()->route('TagsIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $tags = Tags::find($id);
            $tags->delete();
            return redirect()->route('TagsIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function edit($id){
        $data = [
        'title' => 'Update Tags',
        'menu' => 'tag',
        'dropdown' => 'menu',
        'favicons' => Icon::orderby('id','desc')->paginate(1),
        'dropdown1' => '',
        'dropdown2' => '',
        'tags' => Tags::findOrFail($id),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.tags.edit',$data);  
        }
        else
            return redirect()->route('HomePage');
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $tags = Tags::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|max:50|unique:tags,name,'.$tags->id.'id',
            'slug'  => 'required|max:50|unique:tags,slug,'.$tags->id.'id',
            'status' => 'boolean',
        ]);
        $tags->name = $request->name;
        $tags->slug = str_slug($request->slug);
        $tags->updated_at = date("Y-m-d G:i:s");
        if($request->status !=null){
              $tags->status = $request->status;
            }
            else{
              $tags->status = 0;
            }
        $tags->update();
        Session::flash('Success','Sub Tags has been updated..!');
        return redirect()->route('TagsIndex');
    }
    public function view(Request $request, $id){
        $data = [
            'title' => 'Show Tags',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'menu' => 'tag',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'dropdown2' => '',
            'tags' => Tags::find($id),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.tags.view',$data);
      }
      else
            return redirect()->route('HomePage');
    }
}
