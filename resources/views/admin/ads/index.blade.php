@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">广告列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="adadd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>标题</th>
                            <th>副标题</th>
                            <th>图片</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="ad-list">
                        @foreach($ads as $ad)
                            <tr id="ad{{ $ad->id }}">
                                <td>{{$ad->id}}</td>
                                <td>{{$ad->title}}</td>
                                <td>{{$ad->subtitle}}</td>
                                <td><img src="/storage/ads/{{$ad->photo}}" style="width:100px;height:100px"></td>
                                <td>
                                    <button class="btn btn-info adedit" value="{{$ad->id}}">编辑</button>
                                    <button class="btn btn-danger addelete" value="{{$ad->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$ads -> links()}}
            </div>
            @include('admin.ads.form')
        </main>
    </div>
</div>
@endsection