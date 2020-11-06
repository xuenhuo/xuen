@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">订单列表</h2>
            <div class="table-responsive">
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>用户情况</th>
                            <th>产品情况</th>
                            <th></th>
                            <th>数量</th>
                            <th>总价</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        @foreach($orders as $order)
                            <tr id="order{{ $order->id }}">
                                <td>{{$order->num}}</td>
                                <td>
                                    @foreach ($order->contacts as $contact)
                                        <li>{{$contact->name}}</li>
                                        <li>{{$contact->phone_num}}</li>
                                        <li>{{$contact->address}}</li>
                                    @endforeach
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            @foreach ($order->products as $product)
                                                {{$product->title}}
                                            @endforeach
                                        </li>
                                        <td>
                                            @foreach ($order->attribute_details as $detail)
                                                <li>{{$detail->title}}|{{$detail->price}}</li>
                                            @endforeach
                                        </td>
                                    </ul>
                                </td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <button class="btn btn-info odedit" value="{{$order->id}}">编辑</button>
                                    <button class="btn btn-danger oddelete" value="{{$order->id}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$products -> links()}} --}}
            </div>
            @include('admin.products.orders.form')
        </div>
    </div>
</div>
@endsection