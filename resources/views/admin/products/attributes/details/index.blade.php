@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">款式细节列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="dtadd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>款式</th>
                            <th>标题</th>
                            <th>价格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="detail-list">
                        @foreach ($details as $detail)
                            <tr id="detail{{ $detail->id }}">
                                <td>{{$detail->attribute_id}}</td>
                                <td>{{$detail->title}}</td>
                                <td>{{$detail->price}}</td>
                                <td>
                                    <button class="btn btn-info dtedit" value="{{$detail->id}}" data-url="/{{$detail->attribute_id}}/attribute_details">编辑</button>
                                    <button class="btn btn-danger dtdelete" value="{{$detail->id}}" data-url="{{route('admin.attributes.attribute_details.destroy', [$detail->attribute_id, $detail->id])}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$details -> links()}}
            </div>
            @include('admin.products.attributes.details.form')
        </div>
    </div>
</div>
@endsection

