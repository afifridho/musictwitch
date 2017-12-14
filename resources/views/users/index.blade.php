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
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <a class="btn btn-link pull-right" href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-pencil fa-lg"></i></a>
            <img class="profile-user-img img-responsive img-circle" width="20px" height="20px" src="{{ $user->profile_pictures }}" />
            <h3 class="profile-username text-center">{{ $user->name }}</h3>
            <!-- <p class="text-muted text-center"></p> -->

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Followers</b> <a class="pull-right">{{ count($user->followers) }}</a>
              </li>
              <li class="list-group-item">
                <b>Following</b> <a class="pull-right">{{ count($user->following) }}</a>
              </li>
            </ul>
            @if ($user->id != Auth::user()->id)
              @php
                $followingid = array();
                foreach (Auth::user()->following as $key => $following){
                  array_push($followingid, $following->id);
                }
              @endphp
              @if (!in_array($user->id, $followingid))
              <form action="{{ route('users.follow', $user->id) }}" method="POST" accept-charset="utf-8">
               {{ csrf_field() }}
                <button type="submit" class="btn btn-primary btn-block"><b>Follow</b></button>
              </form>
              @else
              <form action="{{ route('users.unfollow', $user->id) }}" method="POST" accept-charset="utf-8">
               {{ csrf_field() }}
               <button type="submit" class="btn btn-danger btn-block"><b>Unfollow</b></button>
              </form>
              @endif
            @else
            @endif
            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <!-- <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
          </div> -->
          <!-- /.box-header -->
          <!-- <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

            <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

            <p class="text-muted">Malibu, California</p>

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

            <p>
              <span class="label label-danger">UI Design</span>
              <span class="label label-success">Coding</span>
              <span class="label label-info">Javascript</span>
              <span class="label label-warning">PHP</span>
              <span class="label label-primary">Node.js</span>
            </p>

            <hr>

            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
          </div> -->
          <!-- /.box-body -->
        <!-- </div> -->
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Activity</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @if($user->id == Auth::user()->id)
            <div class="record-info">
              <h1>Please Record to <a href="#">rtmp://10.151.36.34/{{ $user->username }}/test</a></h1>
            </div>
            @endif
            <br>
            <div class="video-box">
              <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="268"
              data-setup='{}'>
                <source src="rtmp://10.151.36.35/{{ $user->username }}/test" type='rtmp/mp4'>
              </video>
              <h2><iframe src="http://10.151.36.35/nclients?app={{ $user->username }}&name=test" width="150px" height="40px"></iframe> Viewers</h2>
            </div>
            <br>
            <hr>
            <br>
            <div id="chat-{{ $user->id }}" class="chatbox" user="{{ Auth::user()->username }}">
              <ul id="messages"></ul>
              <span id="notifyUser"></span>
              <form id="form" action="" onsubmit=" return submitfunction();" >
                <input type="hidden" id="user" value="" />
                <input style="width: 60%; border:0px; padding:10px 5%" id="m" autocomplete="off" onkeyup="notifyTyping();" placeholder="Say something..." />
                <button type="submit" id="button" value="Send">Send</button>
              </form>
            </div>
            <!-- <div class = "col-md-5 col-sm-5 col-xs-5">
                    <iframe class= "chat-frame" src="http://localhost:3000"  scrolling="yes"></iframe>
                </div> -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.nav-tabs-custom -->
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
