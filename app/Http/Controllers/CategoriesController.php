<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categories;
use App\Articles;
use App\Icon;
use Auth;
use File;
use Session;

class CategoriesController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Categories',
            'menu' => 'categories',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'categories_p' => Categories::where('status','=','1')->get(),
            'categories_a' => Categories::all(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $categories = Categories::where('id','=',$request->search)
                    ->Orwhere('name','LIKE','%'.$request->search.'%')
                    ->Orwhere('slug','LIKE','%'.$request->search.'%')
                    ->orderby('order','asc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }else
                $categories = Categories::orderby('order','asc')
                    ->paginate(6);
                return view('backend.pages.categories.index',$data, compact('categories'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New Categories',
            'menu' => 'categories',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.categories.create',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        $this->validate($request,[
              'name' => 'required|max:100|min:3|unique:categories',
              'slug'  => 'required|max:100|min:2|unique:categories',
              'dir'  => 'required|max:100|min:2|unique:categories',
              'status' => 'boolean',
              'order' => 'required|numeric|unique:categories',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $categories = new Categories();
            $categories->name = $request->name;
            $categories->slug = str_slug($request->slug);
            $categories->dir = $request->dir;
            $categories->order = $request->order;
            $path_name = $request->dir;
            $path = public_path().'/images/posts/'. $path_name;
            File::makeDirectory($path, $mode = 0777, true, true);
            $categories->created_by = Auth::user()->id;
            if($request->status !=null){
              $categories->status = $request->status;
            }
            else{
              $categories->status = 0;
            }
            $categories->save();
            Session::flash('Success','New Categories has been created..!');
            return redirect()->route('CategoriesIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if (Auth::user()->role_id == 1 && Auth::user()->status == 1) {
            $category = Categories::find($id);
            $path = public_path().'/images/posts/'. $category->dir;
            $delete_dir = File::deleteDirectory($path);
            $category->delete();
            return redirect()->route('CategoriesIndex');   
            }
            else 
            return redirect()->route('CategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function edit($id){
        $categories = Categories::findOrFail($id);
        if($categories->status == 1){
            $categories->status = "checked";
        }else
            $categories->status = "";
        $data = [
        'title' => 'Update Categories',
        'menu' => 'categories',
        'dropdown' => 'menu',
        'dropdown1' => '',
        'favicons' => Icon::orderby('id','desc')->paginate(1),
        'dropdown2' => '',
        'categories' => Categories::findOrFail($id),
        'categories_status' => $categories->status,
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.categories.edit',$data);  
        }
        else
            return redirect()->route('HomePage');
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $categories = Categories::find($id);
        $this->validate($request,[
            'name' => 'required|max:100|min:3|unique:categories,name,'.$categories->id.'id',
            'slug'  => 'required|max:100|min:2|unique:categories,slug,'.$categories->id.'id',
            'dir'  => 'required|max:100|min:2|unique:categories,dir,'.$categories->id.'id',
            'order'  => 'required|unique:categories,order,'.$categories->id.'id',
            'status' => 'boolean'
        ]);
        $categories->name = $request->name;
        $categories->slug = str_slug($request->slug);
        $categories->order = $request->order;
        $categories->updated_at = date("Y-m-d G:i:s");

        $path_name = $categories->dir;
        $old_path = public_path().'/images/posts/'.$path_name;
        $path_name1 = $request->dir;
        $new_path = public_path().'/images/posts/'.$path_name1;
        File::move($old_path, $new_path);
        $categories->dir = $request->dir;
        if($request->status !=null){
              $categories->status = $request->status;
            }
            else{
              $categories->status = 0;
            }
        $categories->update();
        Session::flash('Success','Categories has been updated..!');
        return redirect()->route('CategoriesIndex');
    }
    public function view(Request $request, $id){
        $data = [
            'title' => 'Show Categories',
            'menu' => 'categories',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
            'categories' => Categories::find($id),
            'articles' => Articles::where('categories_id','=',$id)->orderby('id','desc')->paginate(10),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.categories.view',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function unpublish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $categories = Categories::find($id);
            $categories->status = 0;
            $categories->save();
            return redirect()->route('CategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function publish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $categories = Categories::find($id);
            $categories->status = 1;
            $categories->save();
            return redirect()->route('CategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
}
