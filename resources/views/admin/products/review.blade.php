@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">评论列表</h2>
            <div class="table-responsive">
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>产品ID</th>
                            <th>ID</th>
                            <th>用户ID</th>
                            <th>内容</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="review-list">
                        @foreach ($reviews as $review)
                            <tr id="review{{ $review->id }}">
                                <td>{{$review->product_id}}</td>
                                <td>{{$review->id}}</td>
                                <td>{{$review->user_id}}</td>
                                <td>{{$review->content}}</td>
                                <td>
                                    <form action="{{route('admin.products.reviews.destroy', [$review->product_id, $review->id])}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" value="{{$review->id}}" data-url="{{route('admin.products.reviews.destroy', [$review->product_id, $review->id])}}">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$reviews -> links()}}
            </div>
        </div>
    </div>
</div>
@endsection

