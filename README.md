<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## HOW TO RUN
git pull origin master/git clone ssh

//需要手动创建MySQL utf8mb4_unicode_ci数据库

cp .env.example .env

//修改.env里面的数据库信息

composer install  // 安装依赖

php artisan migrate  // 数据库迁移

php artisan storage:link  // 创建storage与public的链接

php artisan key:generate  //生成应用的key

php artisan serve //启动服务器

php artisan tinker //进入应用交互模式后使用model create语句注册管理员

Admin::create(['name'=>'your_name','email'=>'your_email','password'=>Hash::make('your_password')])

## ROUTES
位于routes里，只用web.php及api.php

## VIEWS
分为前后台视图

前台视图文件在fashe文件夹里面，包括主页，产品页，博客页，关于页，联系页，以及购物车页面等

主页主要包括主页滚动广告，产品推荐，博客推荐等信息；产品页主要为产品信息；博客页是文章由管理员编写，用户主要为评论者；购物车页面由导航条右上角进入；以及其他信息页面。

后台视图文件在admin文件夹里面，包括产品页，主页广告，文章（博客），管理员，登录页面，主页文件在layouts文件里的admin

后台表单页面使用Javascript+Ajax直接创建新数据，不需要进行页面的跳转。

## CONTROLLER
分为前后台控制器

前台控制器在Controllers里且注册控制器均位于auth文件夹

后台控制器在Controllers的Admin文件夹里

## MODEL
模型位于app文件夹的model里

## CSS JS
后台的CSS文件利用resources/sass/app.sass进行修改 使用命令 npm run watch

    JS文件位于public/js里

前台CSS以及JS文件均位于public里