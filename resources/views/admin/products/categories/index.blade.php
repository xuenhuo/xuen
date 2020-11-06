@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">分类列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="cgadd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>图片</th>
                            <th>是否隐藏</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="category-list">
                        @foreach($categories as $category)
                            <tr id="category{{ $category->id }}">
                                <td>{{$category->title}}</td>
                                <td><img src="/storage/categories/{{$category->photo}}" style="width:100px;height:100px"></td>
                                <td>{{$category->disabled}}</td>
                                <td>
                                    <button class="btn btn-info cgedit" value="{{$category->id}}">编辑</button>
                                    <button class="btn btn-danger cgdelete" value="{{$category->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.products.categories.form')
        </div>
    </div>
</div>
@endsection