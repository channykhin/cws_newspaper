<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Helpers;
use App\Icon;
use App\Ads;
use App\Logo;
use App\Categories;
use App\SubCategories;
use App\Tags;
use App\Articles;

class HomeController extends Controller
{
    public function index(){
        
    	$data = [
            'title' => 'Home Page',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'featured_post1' => Articles::where('status','=',1)->orderby('id','desc')->take(1)->get(),
            'featured_post2' => Articles::where('status','=',1)->orderby('id','desc')->skip(1)->take(6)->get(),
            'articles_most_view' => Articles::orderby('views','desc')->paginate(5),
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),
    	];
    	return view('frontend.pages.index', $data);

    }
    public function getArticleByCate(Request $request, $slug){
        $cate = Categories::where('slug','=',$slug)->first();
        $articles = Articles::where('categories_id','=',$cate->id)->paginate(15);
        $data = [
            'title' => $cate->name,
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'articles_most_view' => Articles::where('status',1)->orderBy('views','desc')->take(5)->get(), 
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),
        ];
        return view('frontend.pages.categories',$data,compact('cate','articles'));
    }
    public function getArticleBySubCate(Request $request,$slug, $name){
        $cate = SubCategories::where('name','=',$name)->first();
        $articles = Articles::where('sub_categories_id','=',$cate->id)->paginate(15);
        $data = [
            'title' => $cate->name,
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'articles_most_view' => Articles::where('status',1)->orderBy('views','desc')->take(5)->get(), 
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),   
        ];
        return view('frontend.pages.categories',$data,compact('cate','articles'));
    }
    public function getArticleBySearch(Request $request){
        $data = [
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'articles_most_view' => Articles::where('status',1)->orderBy('views','desc')->take(5)->get(), 
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),   
            'keyword' => $request->keyword,
        ];
        if($request->has('keyword')){
            $articles = Articles::where('id','=',$request->keyword)
                ->Orwhere('title','LIKE','%'.$request->keyword.'%')
                ->Orwhere('slug','LIKE','%'.$request->keyword.'%')
                ->orderby('id','desc')
                ->get();
            return view('frontend.pages.search', $data, compact('articles'));
        }
    }
    public function ArticleDetail(Request $request, $id){
        $articles = Articles::find($id);
        $data = [
            'title' => $articles->title,
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'recent_post' => Articles::where('status',1)->orderBy('id','desc')->take(5)->get(), 
            'articles_most_view' => Articles::where('status',1)->orderBy('views','desc')->take(5)->get(),   
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),   
        ];
        return view('frontend.pages.detail',$data,compact('articles'));
    }
    public function advertisement(){
        $data = [
            'title' => 'Advertisement',
            'favicons' => Icon::orderby('id','desc')->paginate(1),
            'logos' => Logo::orderby('id','desc')->paginate(1),
            'ads_a1' => Ads::where('position','=','Next Logo')->orderby('id','desc')->get(),
            'menus' => Categories::where('status','=',1)->orderby('order','asc')->get(),
            'featured_post1' => Articles::where('status','=',1)->orderby('id','desc')->take(1)->get(),
            'featured_post2' => Articles::where('status','=',1)->orderby('id','desc')->skip(1)->take(6)->get(),
            'articles_most_view' => Articles::orderby('views','desc')->paginate(5),
            'en' => Helpers::time_en(),
            'kh' => Helpers::time_kh(),
            'num_en' => Helpers::number_en(),
            'num_kh' => Helpers::number_kh(),
        ];
        return view('frontend.pages.advertisement', $data);
    }
}
