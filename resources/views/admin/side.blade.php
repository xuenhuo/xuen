<?php
    $routeArray = app('request')->route()->getAction();
    $controllerAction = class_basename($routeArray['controller']);
    list($controller, $action) = explode('@', $controllerAction);
?>
<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
            <a class="{{$controller == 'AdminController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.home')}}">控制面板</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'AdController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.ads.index')}}">主页广告</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'ProductController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.products.index')}}">产品列表</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'CategoryController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.categories.index')}}">分类列表</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'AttributeController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.attributes.index')}}">款式列表</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'OrderController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.orders.index')}}">订单详情</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'ArticleController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.articles.index')}}">博客文章</a>
        </li>
        <li class="nav-item">
            <a class="{{$controller == 'ManagerController' ? 'nav-link active' : 'nav-link'}}" href="{{route('admin.managers.index')}}">管理员</a>
        </li>
      </ul>
    </div>
</nav>