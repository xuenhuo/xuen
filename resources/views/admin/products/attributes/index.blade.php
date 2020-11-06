@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">产品款式列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="atadd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="attribute-list">
                        @foreach($attributes as $attribute)
                            <tr id="attribute{{ $attribute->id }}">
                                <td>{{$attribute->title}}</td>
                                <td>{{$attribute->position}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('admin.attributes.attribute_details.index', [$attribute->id])}}">详情</a>
                                    <button class="btn btn-info atedit" value="{{$attribute->id}}">编辑</button>
                                    <button class="btn btn-danger atdelete" value="{{$attribute->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.products.attributes.form')
        </div>
    </div>
</div>
@endsection