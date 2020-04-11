<?php

// BACKEND

Route::group(['prefix' => '/tpk'], function () {
	Route::get('/user/login', ['as' => 'getUserLogin', 'uses' => 'AuthController@getLogin']);
	Route::post('/user/login', ['as' => 'postUserLogin', 'uses' => 'AuthController@postLogin']);
	Route::get('/user/register', ['as' => 'getUserRegister', 'uses' => 'AuthController@getRegister']);
	Route::post('/user/register', ['as' => 'postUserRegister', 'uses' => 'AuthController@postRegister']);
	Route::get('/user/logout', ['as' => 'getUserLogout', 'uses' => 'AuthController@getLogout']);
	Route::get('/user/reset_password', ['as' => 'getUserResetPassword', 'uses' => 'AuthController@getLogout']);
	
	// Middleware AdminDashboard
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/', ['as' => 'UserDashboard', 'uses' => 'UserController@index']);
		Route::group(['prefix' => '/content'], function(){

			//Categories
			Route::get('/categories/', ['as' => 'CategoriesIndex', 'uses' => 'CategoriesController@index']);
			Route::get('/categories/create', ['as' => 'CategoriesCreate', 'uses' => 'CategoriesController@create']);
			Route::get('/categories/destroy/{id}', ['as' => 'CategoriesDestroy', 'uses' => 'CategoriesController@destroy']);
			Route::get('/categories/edit/{id}', ['as' => 'CategoriesEdit', 'uses' => 'CategoriesController@edit']);
			Route::post('/categories/create', ['as' => 'CategoriesStore', 'uses' => 'CategoriesController@store']);
			Route::post('/categories/update/{id}', ['as' => 'CategoriesUpdate', 'uses' => 'CategoriesController@update']);
			Route::get('/categories/view/{id}', ['as' => 'CategoriesView', 'uses' => 'CategoriesController@view']);
			Route::get('/categories/unpublish/{id}', ['as' => 'CategoriesUnpublish', 'uses' => 'CategoriesController@unpublish']);
			Route::get('/categories/publish/{id}', ['as' => 'CategoriesPublish', 'uses' => 'CategoriesController@publish']);

			//Sub Categories
			Route::get('/sub-categories/', ['as' => 'SubCategoriesIndex', 'uses' => 'SubCategoriesController@index']);
			Route::get('/sub-categories/create', ['as' => 'SubCategoriesCreate', 'uses' => 'SubCategoriesController@create']);
			Route::get('/sub-categories/destroy/{id}', ['as' => 'SubCategoriesDestroy', 'uses' => 'SubCategoriesController@destroy']);
			Route::get('/sub-categories/edit/{id}', ['as' => 'SubCategoriesEdit', 'uses' => 'SubCategoriesController@edit']);
			Route::post('/sub-categories/create', ['as' => 'SubCategoriesStore', 'uses' => 'SubCategoriesController@store']);
			Route::post('/sub-categories/update/{id}', ['as' => 'SubCategoriesUpdate', 'uses' => 'SubCategoriesController@update']);
			Route::get('/sub-categories/view/{id}', ['as' => 'SubCategoriesView', 'uses' => 'SubCategoriesController@view']);
			Route::get('/sub-categories/unpublish/{id}', ['as' => 'SubCategoriesUnpublish', 'uses' => 'SubCategoriesController@unpublish']);
			Route::get('/sub-categories/publish/{id}', ['as' => 'SubCategoriesPublish', 'uses' => 'SubCategoriesController@publish']);

			//Tags
			Route::get('/tag',['as' => 'TagsIndex','uses'=>'TagsController@index']);
			Route::get('tag/create',['as' => 'TagsCreate','uses'=>'TagsController@create']);
			Route::post('/tag/create', ['as' => 'TagsStore', 'uses' => 'TagsController@store']);
			Route::get('tag/destroy/{id}',['as' => 'TagsDestroy' ,'uses' => 'TagsController@destroy']);
			Route::get('tag/edit/{id}',['as' => 'TagsEdit' ,'uses' => 'TagsController@edit']);
			Route::post('tag/edit/{id}', ['as' => 'TagsUpdate', 'uses' => 'TagsController@update']);
			Route::get('tag/view/{id}', ['as' => 'TagsView', 'uses' => 'TagsController@view']);
			Route::get('/tag/unpublish/{id}', ['as' => 'TagsUnpublish', 'uses' => 'TagsController@unpublish']);
			Route::get('/tag/publish/{id}', ['as' => 'TagsPublish', 'uses' => 'TagsController@publish']);

			//Users
			Route::get('/user/permission',['as' => 'UserPermissionIndex' ,'uses' => 'UserPermissionController@index']);
			Route::get('user/create',['as' => 'UsersCreate' ,'uses' => 'UserPermissionController@create']);
			Route::post('user/create',['as' => 'UsersStore' ,'uses' => 'UserPermissionController@store']);
			Route::get('user/destroy/{id}',['as' => 'UsersDestroy' ,'uses' => 'UserPermissionController@destroy']);
			Route::get('user/edit/{id}',['as' => 'UsersEdit' ,'uses' => 'UserPermissionController@edit']);
			Route::post('user/update/{id}',['as' => 'UserUpdate' ,'uses' => 'UserPermissionController@update']);
			Route::get('user/change-password/{id}',['as' => 'UsersChangePassword' ,'uses' => 'UserPermissionController@change_password']);
			Route::post('user/change-password/update/{id}',['as' => 'UsersChangePasswordUpdate' ,'uses' => 'UserPermissionController@change_password_update']);
			Route::post('user/upload/image/{id}',['as' => 'UserUploadImage','uses'=>'UserPermissionController@uploadimage']);
			Route::post('user/destroy/image',['as' => 'UserDestroyImage','uses'=>'UserPermissionController@destroyimage']);
			Route::get('user/view/{id}', ['as' => 'UsersView', 'uses' => 'UserPermissionController@view']);
			Route::get('user/activity/{id}', ['as' => 'UsersActivity', 'uses' => 'UserPermissionController@activity']);
			Route::get('/user/unpublish/{id}', ['as' => 'UsersUnpublish', 'uses' => 'UserPermissionController@unpublish']);
			Route::get('/user/publish/{id}', ['as' => 'UsersPublish', 'uses' => 'UserPermissionController@publish']);

			//Roles
			Route::get('user/role',['as'=>'RolesIndex','uses'=>'UserPermissionController@roles']);
			Route::get('user/role/create',['as'=>'RolesCreate','uses'=>'UserPermissionController@roles_create']);
			Route::post('user/role/store',['as'=>'RolesStore','uses'=>'UserPermissionController@roles_store']);
			Route::get('user/role/view/{id}',['as'=>'RolesView','uses'=>'UserPermissionController@roles_view']);
			Route::get('user/role/edit/{id}',['as'=>'RolesEdit','uses'=>'UserPermissionController@roles_edit']);
			Route::post('user/role/update/{id}',['as'=>'RolesUpdate','uses'=>'UserPermissionController@roles_update']);

			//User Setting
			Route::get('user/profile/',['as' => 'AccountSetting','uses' => 'UserController@profile']);
			Route::get('user/profile/edit/{id}',['as' => 'UsersProfileEdit' ,'uses' => 'UserController@profile_edit']);
			Route::post('user/profile/update/{id}',['as' => 'UsersProfileUpdate' ,'uses' => 'UserController@profile_update']);
			Route::get('user/profile/change-password/{id}',['as' => 'UsersProfilePasswordEdit' ,'uses' => 'UserController@profile_password_edit']);
			Route::post('user/profile/change-password/{id}',['as' => 'UsersProfilePasswordUpdate' ,'uses' => 'UserController@profile_password_update']);

			// // Guide
			// Route::get('guideline',['as'=>'AdministratorGuide','uses'=>'HelperController@index']);

			// Advertisement
			Route::get('/ads',['as' => 'AdsIndex','uses'=>'AdsController@index']);
			Route::get('ads/create',['as' => 'AdsCreate','uses'=>'AdsController@create']);
			Route::post('ads/create',['as' => 'AdsStore','uses'=>'AdsController@store']);
			Route::get('ads/view/{id}',['as' => 'AdsView','uses'=>'AdsController@view']);
			Route::get('ads/destroy/{id}',['as' => 'AdsDestroy','uses'=>'AdsController@destroy']);
			Route::get('ads/edit/{id}',['as' => 'AdsEdit','uses'=>'AdsController@edit']);
			Route::post('ads/edit/{id}',['as' => 'AdsUpdate','uses'=>'AdsController@update']);
			Route::post('ads/destroy/image',['as' => 'AdsDestroyImage','uses'=>'AdsController@destroyimage']);
			Route::post('ads/upload/image/{id}',['as' => 'AdsUploadImage','uses'=>'AdsController@uploadimage']);

			//Articles
			Route::get('article',['as' => 'ArticlesIndex','uses'=>'ArticlesController@index']);
			Route::get('article/create',['as' => 'ArticlesCreate','uses'=>'ArticlesController@create']);
			Route::post('article/create',['as' => 'ArticlesStore','uses'=>'ArticlesController@store']);
			Route::get('article/destroy/{id}',['as' => 'ArticlesDestroy','uses'=>'ArticlesController@destroy']);
			Route::get('article/edit/{id}',['as' => 'ArticlesEdit','uses'=>'ArticlesController@edit']);
			Route::post('article/edit/{id}',['as' => 'ArticlesUpdate','uses'=>'ArticlesController@update']);

			Route::post('article/destroy/image',['as' => 'ArticlesDestroyImage','uses'=>'ArticlesController@destroyimage']);

			Route::post('article/destroy/slider/image',['as' => 'ArticlesDestroyImage1','uses'=>'ArticlesController@destroyimage1']);

			Route::post('article/upload/image/{id}',['as' => 'ArticsleUploadImage','uses'=>'ArticlesController@uploadimage']);

			Route::post('article/slider/image/{id}',['as' => 'ArticsleUploadImage1','uses'=>'ArticlesController@uploadimage1']);

			Route::get('/article/view/{id}', ['as' => 'ArticlesView', 'uses' => 'ArticlesController@view']);

			Route::get('/article/unpublish/{id}', ['as' => 'ArticlesUnpublish', 'uses' => 'ArticlesController@unpublish']);
			Route::get('/article/publish/{id}', ['as' => 'ArticlesPublish', 'uses' => 'ArticlesController@publish']);

			//logo and favicon
			Route::get('/logo-favicon',['as' => 'LogoIconIndex','uses' => 'LogoIconController@index']);
			Route::get('/logo/create',['as' => 'LogoCreate','uses' => 'LogoIconController@logo']);
			Route::post('/logo/create',['as' => 'LogoStore','uses' => 'LogoIconController@logo_store']);
			Route::get('/favicon/create',['as' => 'FaviconCreate','uses' => 'LogoIconController@favicon']);
			Route::post('/favicon/create',['as' => 'FaviconStore','uses' => 'LogoIconController@favicon_store']);

			//System 
			Route::get('/system/customize',['as' => 'System','uses' => 'UserController@system']);

			//Reports
			Route::get('/aricles/reports',['as' => 'ReportsIndex','uses' => 'ReportsController@index']);
		});
	});
});

// FRONTEND
Route::get('/', ['as' => 'HomePage', 'uses' => 'HomeController@index']);
Route::get('/advertisement', ['as' => 'Advertisement', 'uses' => 'HomeController@advertisement']);
Route::get('/categories/{slug}', ['as' => 'getArticleByCate', 'uses' => 'HomeController@getArticleByCate']);
Route::get('/categories/{slug}/{name}', ['as' => 'getArticleBySubCate', 'uses' => 'HomeController@getArticleBySubCate']);
Route::get('/article/{id}', ['as' => 'ArticleDetail', 'uses' => 'HomeController@ArticleDetail']);
Route::get('/search', ['as' => 'SearchKeyword', 'uses' => 'HomeController@getArticleBySearch']);
