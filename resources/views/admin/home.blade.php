@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <div class="row">
      @include('admin.side')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <h2 class="w-25 p-3">控制面板</h2>
      <div class="table-responsive">
        <p>用户IP地址：{{$data}}</p>
      </div>
    </main>
  </div>
</div>

@endsection