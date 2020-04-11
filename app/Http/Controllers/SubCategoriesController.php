<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\SubCategories;
use App\Categories;
use App\Articles;
use App\Icon;
use Auth;
use File;
use Session;

class SubCategoriesController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Sub Categories',
            'menu' => 'categories',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown' => 'menu',
            'dropdown1' => '',
            'dropdown2' => '',
            'sub_categories_p' => SubCategories::where('status','=','1')->get(),
            'sub_categories_a' => SubCategories::all(),
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $subcategories = SubCategories::where('id','=',$request->search)
                    ->Orwhere('name','LIKE','%'.$request->search.'%')
                    ->Orwhere('slug','LIKE','%'.$request->search.'%')
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }else
                $subcategories = SubCategories::orderby('id','desc')
                    ->paginate(6);
                return view('backend.pages.categories.sub-index',$data, compact('subcategories'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New Sub Categories',
            'menu' => 'categories',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
            'categories' => Categories::where('status','=',1)
            	->get(),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.categories.create-sub',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
              'name' => 'required|max:100|min:3|unique:sub_categories',
              'slug'  => 'required|max:100|min:2|unique:sub_categories',
              'status' => 'boolean',
              'order' => 'required',
              'categories_id' => 'required',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $subcategories = new SubCategories();
            $subcategories->name = $request->name;
            $subcategories->slug = str_slug($request->slug);
            $subcategories->order = $request->order;
            $subcategories->categories_id = $request->categories_id;
            if($request->status !=null){
              $subcategories->status = $request->status;
            }
            else{
              $subcategories->status = 0;
            }
            $subcategories->save();
            Session::flash('Success','New Sub Categories has been created..!');
            return redirect()->route('SubCategoriesIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function edit($id){
        $subcategories = SubCategories::findOrFail($id);
        if($subcategories->status == 1){
            $subcategories->status = "checked";
        }else
            $subcategories->status = "";
        $data = [
        'title' => 'Update Sub Categories',
        'menu' => 'categories',
        'dropdown' => 'menu',
        'favicons' => Icon::orderby('id','desc')->paginate(1),
        'dropdown1' => '',
        'dropdown2' => '',
        'subcategories' => SubCategories::findOrFail($id),
        'categories' => Categories::where('status','=',1)
                ->get(),
        'sub_categories_status' => $subcategories->status,
        ];
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.categories.sub-edit',$data);  
        }
        else
            return redirect()->route('HomePage');
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $subcategories = SubCategories::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|max:100|min:3|unique:sub_categories,name,'.$subcategories->id.'id',
            'slug'  => 'required|max:100|min:2|unique:sub_categories,slug,'.$subcategories->id.'id',
            'status' => 'boolean',
        ]);
        $subcategories->name = $request->name;
        $subcategories->slug = str_slug($request->slug2);
        $subcategories->order = $request->order;
        $subcategories->categories_id = $request->categories_id;
        $subcategories->updated_at = date("Y-m-d G:i:s");
        if($request->status !=null){
              $subcategories->status = $request->status;
            }
            else{
              $subcategories->status = 0;
            }
        $subcategories->update();
        Session::flash('Success','Sub Categories has been updated..!');
        return redirect()->route('SubCategoriesIndex');
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if (Auth::user()->role_id == 1 && Auth::user()->status == 1) {
            $subcategory = SubCategories::find($id);
            $subcategory->delete();
            return redirect()->route('SubCategoriesIndex');   
            }
            else 
            return redirect()->route('SubCategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function view(Request $request, $id){
        $data = [
            'title' => 'Show Sub Categories',
            'menu' => 'categories',
            'dropdown' => 'menu',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown1' => '',
            'dropdown2' => '',
            'subcategories' => SubCategories::find($id),
            'articles' => Articles::where('sub_categories_id','=',$id)->orderby('id','desc')->paginate(10),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.categories.sub-view',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function unpublish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $subcategories = SubCategories::find($id);
            $subcategories->status = 0;
            $subcategories->save();
            return redirect()->route('SubCategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function publish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $subcategories = SubCategories::find($id);
            $subcategories->status = 1;
            $subcategories->save();
            return redirect()->route('SubCategoriesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
}
