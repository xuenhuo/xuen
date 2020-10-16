@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.side')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div id="debug"></div>
            <h2 class="w-25 p-3">产品列表</h2>
            <div class="table-responsive">
                <button class="btn btn-primary" id="maadd">添加</button>
                {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>名称</th>
                            <th>邮箱</th>
                        </tr>
                    </thead>
                    <tbody id="manager-list">
                        @foreach($managers as $manager)
                            <tr id="manager{{ $manager->id }}">
                                <td>{{$manager->id}}</td>
                                <td>{{$manager->name}}</td>
                                <td>{{$manager->email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$managers -> links()}}
            </div>
            @include('admin.managers.form')
        </main>
    </div>
</div>
@endsection