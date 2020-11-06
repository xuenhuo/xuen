@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">文章列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="aradd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>作者</th>
                            <th>图片</th>
                            <th>内容</th>
                            <th>评论</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="article-list">
                        @foreach($articles as $article)
                            <tr id="article{{ $article->id }}">
                                <td>{{$article->title}}</td>
                                <td>{{$article->author}}</td>
                                <td><img src="/storage/articles/{{$article->photo}}" style="width:100px;height:100px"></td>
                                <td class="overflow-auto">{{$article->content}}</td>
                                <td>
                                    <button class="btn btn-info comment_btn" data-url="{{route('admin.articles.comments.index', [$article->id])}}">获取评论</button>
                                    <a class="btn btn-info" href="{{route('admin.articles.commentlists.index', [$article->id])}}">获取评论</a>
                                </td>
                                <td>
                                    <button class="btn btn-info aredit" value="{{$article->id}}">编辑</button>
                                    <button class="btn btn-danger ardelete" value="{{$article->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$articles -> links()}} --}}
            </div>
            @include('admin.articles.form')
        </div>
    </div>
</div>

<div id="commentView"></div>
@endsection

