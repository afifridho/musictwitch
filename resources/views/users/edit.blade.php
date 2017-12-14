@extends('layouts.layout')
@section('additionalcss')
<link href="http://vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.11/video.js"></script>

<link rel='stylesheet' href="{{ URL::asset('TChat/style.css') }}" type='text/css'/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="{{ URL::asset('TChat/chat.js') }}"></script>
<style media="screen">
  .record-info{
    border: 2px solid red;
    padding: 20px;
    border-radius: 12px;
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
      User Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">User profile</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-2">

      </div>
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <img class="profile-user-img img-responsive img-circle" src="{{ $user->profile_pictures }}" alt="User profile picture">
            <h3 class="profile-username text-center">{{ $user->name }}</h3>
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
              <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" placeholder="Fill the date here" value="{{ $user->name }}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" placeholder="Fill income name here" value="{{ $user->email }}">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Fill income value here" value="{{ $user->username }}">
              </div>
              <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="file">
                <p class="help-block">Put The Profile Picture file here.</p>
              </div>
              <button type="submit" class="btn btn-primary">Submit Button</button>
              <button type="reset" class="btn btn-default">Reset Button</button>
            </form>
            </div>
            <div class="col-md-2">

            </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <div class="col-md-2">

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
@endsection
@section('additionaljs')
<script type="text/javascript">
(function worker() {
$.ajax({
  url: 'http://10.151.36.35/stat',
  success: function(data) {
    // $('.result').html(data);
    console.log(data);
  },
  complete: function() {
    // Schedule the next request when the current one's complete
    setTimeout(worker, 5000);
  }
});
})();
</script>
@endsection
