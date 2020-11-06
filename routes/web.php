<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台控制器路由
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    //后台主页
    Route::get('/', 'AdminController@index')->name('home');
    //后台登录注册
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    // Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'RegisterController@register');
    Route::post('logout', 'LoginController@logout')->name('logout');
    //后台管理员控制器
    Route::resource('managers', 'ManagerController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台文章控制器
    Route::resource('articles', 'ArticleController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台文章评论控制器（文章子页）
    Route::resource ('articles.comments', 'CommentController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台文章评论控制器（单独页面）
    Route::resource ('articles.commentlists', 'CommentlistController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台产品控制器
    Route::resource('products', 'ProductController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台产品回复控制器
    Route::resource ('products.reviews', 'ReviewController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台产品款式控制器
    Route::resource ('attributes', 'AttributeController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);//后台产品款式控制器
    Route::resource ('attributes.attribute_details', 'Attribute_detailController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台分类控制器
    Route::resource('categories', 'CategoryController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台广告控制器
    Route::resource('ads', 'AdController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    //后台订单控制器
    Route::resource('orders', 'OrderController')->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
});

//前台用户认证
Auth::routes(['verify' => true]);

//前台用户中心
Route::get('index', 'UserController@index')->name('index');
Route::resource('contacts', 'ContactController')->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
]);
//前台主页
Route::get('/', 'HomeController@index')->name('home');
//前台关于我们
Route::get('about', 'HomeController@about')->name('about');
//前台联系我们
Route::get('contact', 'HomeController@contact')->name('contact');
//前台文章控制器
Route::resource('articles', 'ArticleController')->only([
    'index', 'show'
]);
//前台文章评论控制器
Route::resource('articles.comments', 'CommentController')->only([
    'store', 'update', 'destroy'
]);
//前台产品控制器
Route::resource('products', 'ProductController')->only([
    'index', 'show'
]);
//前台产品回复控制器
Route::resource ('products.reviews', 'ReviewController')->only([
    'store', 'update', 'destroy'
]);
//前台分类控制器
Route::resource ('categories', 'CategoryController')->only([
    'index', 'show'
]);
//前台订单控制器
Route::resource ('orders', 'OrderController')->only([
    'index', 'create', 'store'
]);
//前台购物车控制器
Route::resource ('carts', 'CartController')->only([
    'index', 'create', 'store', 'destroy'
]);