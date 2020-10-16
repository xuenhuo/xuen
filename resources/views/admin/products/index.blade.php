@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">产品列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="pradd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>副标题</th>
                            <th>价格</th>
                            <th>折扣价格</th>
                            <th>是否精选</th>
                            <th>图片</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        @foreach($products as $product)
                            <tr id="product{{ $product->id }}">
                                <td>{{$product->title}}</td>
                                <td>{{$product->subtitle}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->sale}}</td>
                                <td>{{$product->featured}}</td>
                                <td><img src="/storage/products/{{$product->photo}}" style="width:100px;height:100px"></td>
                                <td>
                                    <a class="btn btn-info" href="{{route('admin.products.reviews.index', [$product->id])}}">回复详情</a>
                                    <button class="btn btn-info predit" value="{{$product->id}}">编辑</button>
                                    <button class="btn btn-danger prdelete" value="{{$product->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$products -> links()}} --}}
            </div>
            @include('admin.products.form')
        </div>
    </div>
</div>
@endsection