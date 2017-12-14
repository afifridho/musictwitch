@extends('layouts.layout')

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
       <div class="box-body">
        <div class="col-md-12">
          <div class="panel-heading">Dashboard</div>

          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in!
          </div>
        </div>
       </div>
     </div>
  </section>
  <!-- /.content -->
</div>
@endsection
