@extends('layouts.layout')
@section('additionalcss')
<style>
.user-found {
    border: 2px solid grey;
    padding: 20px;
    border-radius: 12px;
    text-decoration: none;
    color: black;
}

.user-found:hover {
    border: 2px solid grey;
    padding: 20px;
    border-radius: 12px;
    background-color: #efefef;
    text-decoration: none;
    color: black;
}
</style>
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Activity</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if($found)
            @foreach($found as $key => $data)
            <a href="{{ route('users.index', $data->id) }}">
              <div class="user-found col-xs-6">
                <div class="pull-left image">
                  <img style="margin-right:20px" src="dist/img/user2-160x160.jpg" class="img-circle" width="100px" height="100px" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p>{{ $data->name }}</p>
                  <p>{{ $data->username }}</p>
                  <p>{{ $data->email }}</p>
                  @if($data->is_live == 0)
                  <p><i class="fa fa-circle text-danger"></i> Currently Not Live</p>
                  @else
                  <p><i class="fa fa-circle text-success"></i> Live Now!</p>
                  @endif
                </div>
              </div>
            </a>
            @endforeach
          @else
            No User Found
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.nav-tabs-custom -->
  </section>
  <!-- /.content -->
</div>
@endsection
