<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use File;
use Response;
use Session;
use Illuminate\Support\Facades\Input;
use App\Articles;
use App\User;
use App\Categories;
use App\SubCategories;
use App\Tags;
use App\Icon;

class ArticlesController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'Articles',
            'menu' => 'article',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'articles_a' => Articles::all(),
            'categories' => Categories::all(),
            'sub_categories' => SubCategories::all(),
            'articles_p' => Articles::where('status','=',1)->get(),
        ];if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            if($request->has('search')){
                $articles = Articles::where('id','=',$request->search)
                    ->Orwhere('title','LIKE','%'.$request->search.'%')
                    ->Orwhere('slug','LIKE','%'.$request->search.'%')
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('search',$request->search);
            }elseif($request->has('filter0')){
                $articles = Articles::where('categories_id','=',$request->filter0)
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('filter0',$request->filter0);
            }elseif($request->has('filter1')){
                $articles = Articles::where('sub_categories_id','=',$request->filter1)
                    ->orderby('id','desc')
                    ->paginate(6)
                    ->appends('filter1',$request->filter1);
            }else
                $articles = Articles::orderby('id','desc')
                    ->paginate(6);
                return view('backend.pages.articles.index',$data, compact('articles'));
        }
        else
            return redirect()->route('HomePage');
    }
    public function create(){
        $data = [
            'title' => 'Add New Articles',
            'menu' => 'article',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'tags' => Tags::where('status',1)->get(),
            'categories' => Categories::where('status',1)->orderby('order','asc')->get(),
            'authors' => User::where('status',1)->orderby('id','desc')->get(),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.articles.create',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function store(Request $request){
        //dd($request->img);
        $this->validate($request,[
              'title' => 'required|max:200|min:3|unique:articles',
              'short_desc'  => 'required|min:10|unique:articles',
              'body'  => 'required|min:10|unique:articles',
              'categories_id'  => 'required',
              'sub_categories_id'  => 'required',
              'img'  => 'required',
              'img_slider'  => 'required',
              'status' => 'boolean',
          ]);
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $articles = new Articles();
            $articles->title = $request->title;
            $articles->slug = str_slug($request->slug);
            $articles->short_desc = $request->short_desc;
            $articles->body = $request->body;
            $articles->author = $request->author;
            $articles->reference = $request->reference;
            $articles->reference_link = $request->reference_link;
            if($request->sub_categories_id > 0){
                $articles->sub_categories_id = $request->sub_categories_id;
            } else{
                $articles->sub_categories_id = null;
            }
            $articles->user_id = Auth::user()->id;

            $cate_name = Categories::find($request->categories_id);
            $cate_dir = $cate_name->dir;

            $image = $request->img;
            $extension = $image->getClientOriginalExtension();
            $filename = str_random(12).".{$extension}";
            File::move($image,public_path().'/images/posts/'.$cate_dir.'/'.$filename);
            $articles->img = $filename;

            $slider = $request->img_slider;
            $extension = $slider->getClientOriginalExtension();
            $filename = str_random(6).".{$extension}";
            File::move($slider,public_path().'/images/posts/'.$cate_dir.'/'.$filename);
            $articles->img_slider = $filename;

            $articles->categories_id = $request->categories_id;
            if($request->status !=null){
              $articles->status = $request->status;
            }
            else{
              $articles->status = 0;
            }
            $articles->save();
            if(isset($request->tags)){
                $articles->tags()->sync($request->tags,false);
            } else{
                $articles->tags()->sync(array());
            }
            Session::flash('Success','New Articles has been created..!');
            return redirect()->route('ArticlesIndex');
        }else
            return redirect()->route('HomePage');
    }
    public function unpublish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $articles = Articles::find($id);
            $articles->status = 0;
            $articles->save();
            return redirect()->route('ArticlesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function publish($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $articles = Articles::find($id);
            $articles->status = 1;
            $articles->save();
            return redirect()->route('ArticlesIndex'); 
        }
        else
            return redirect()->route('HomePage');
    }
    public function destroy($id){
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            $articles = Articles::find($id);
            $cate = Categories::find($articles->categories_id);
            $cate_dir = $cate->dir;
            if($articles->img){
                File::delete(public_path().'/images/posts/'.$cate_dir.'/'.$articles->img);
                File::delete(public_path().'/images/posts/'.$cate_dir.'/'.$articles->img_slider);
            }
            $articles->delete();
            return redirect()->route('ArticlesIndex');   
        }
        else
            return redirect()->route('HomePage');
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Article',
            'menu' => 'article',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'dropdown2' => '',
            'articles' => Articles::findOrFail($id),
            'categories' => Categories::where('status',1)->orderby('order','asc')->get(),
            'authors' => User::where('status',1)->orderby('id','desc')->get(),
        ];
        $tags = Tags::where('status','=',1)
                ->get();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
            return view('backend.pages.articles.edit',$data)->withTags($tags2);  
        }
        else
        return redirect()->route('HomePage');
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $articles = Articles::find($id);
        $this->validate($request,[
            'title' => 'required|max:100|min:3|unique:articles,title,'.$articles->id.'id',
            'short_desc' => 'required|min:3|unique:articles,short_desc,'.$articles->id.'id',
            'body' => 'required|min:3|unique:articles,body,'.$articles->id.'id',
            'categories_id'  => 'required',
            'sub_categories_id'  => 'required',
            //'img'  => 'required',
            'status' => 'boolean',

        ]);
        $articles->title = $request->title;
        $articles->slug = str_slug($request->slug);
        $articles->short_desc = $request->short_desc;
        $articles->body = $request->body;
        $articles->categories_id = $request->categories_id;
        $articles->author = $request->author;
        $articles->reference = $request->reference;
        $articles->reference_link = $request->reference_link;
        $articles->user_id = Auth::user()->id;
        $articles->updated_at = date("Y-m-d G:i:s");
        if($request->sub_categories_id > 0){
            $articles->sub_categories_id = $request->sub_categories_id;
        } else{
            $articles->sub_categories_id = null;
        }
        if($request->status !=null){
          $articles->status = $request->status;
        }
        else{
          $articles->status = 0;
        }
        $articles->update();
        if(isset($request->tags)){
            $articles->tags()->sync($request->tags);
        } else{
            $articles->tags()->sync(array());
        }
        Session::flash('Success','Articles has been updated..!');
        return redirect()->route('ArticlesIndex'); 
    }
    public function view(Request $request, $id){
        $data = [
            'title' => 'Show Articles',
            'menu' => 'article',
            'dropdown' => 'menu',
            'dropdown1' => '',
            'dropdown2' => '',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'articles' => Articles::find($id),
        ];
      if (Auth::user()->role_id == 1 && Auth::user()->status == 1 OR Auth::user()->role_id == 2 && Auth::user()->status == 1) {
        return view('backend.pages.articles.view',$data);
      }
      else
            return redirect()->route('HomePage');
    }
    public function destroyimage(Request $request){
        if($request->ajax()){
            $articles = Articles::find($request->key);
            $cate = Categories::find($articles->categories_id);
            File::delete(public_path().'/images/posts/'.$cate->dir.'/'.$articles->img);;
            $articles->img = null;
            $articles->img_slider = null;
            $articles->save();
            echo 1;
        }  
    }
    public function destroyimage1(Request $request){
        if($request->ajax()){
            $articles = Articles::find($request->key);
            $cate = Categories::find($articles->categories_id);
            File::delete(public_path().'/images/posts/'.$cate->dir.'/'.$articles->img_slider);
            $articles->img_slider = null;
            $articles->save();
            echo 1;
        }  
    }
    public function uploadimage(Request $request,$id){
        if($request->hasFile('img')){
            $articles = Articles::find($id);
            $cate = Categories::find($articles->categories_id);
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $filename = str_random(12).".{$extension}";
            if(File::move($image,public_path().'/images/posts/'.$cate->dir.'/'.$filename)){
                $articles->img = $filename;
                $articles->save();
                echo 1;
            }
        }
    }
    public function uploadimage1(Request $request,$id){
        if($request->hasFile('img_slider')){
            $articles = Articles::find($id);
            $cate = Categories::find($articles->categories_id);
            $image = $request->file('img_slider');
            $extension = $image->getClientOriginalExtension();
            $filename = str_random(6).".{$extension}";
            if(File::move($image,public_path().'/images/posts/'.$cate->dir.'/'.$filename)){
                $articles->img_slider = $filename;
                $articles->save();
                echo 1;
            }
        }
    }
}
