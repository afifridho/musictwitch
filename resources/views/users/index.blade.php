@extends('layouts.layout')
@section('additionalcss')
<link href="http://vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.11/video.js"></script>

<link rel='stylesheet' href="{{ URL::asset('TChat/style.css') }}" type='text/css'/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="{{ URL::asset('TChat/chat.js') }}"></script>
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
            <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <!-- <p class="text-muted text-center"></p> -->

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Followers</b> <a class="pull-right">1,322</a>
              </li>
              <li class="list-group-item">
                <b>Following</b> <a class="pull-right">543</a>
              </li>
            </ul>
            <!-- <form action="route('user.follow', $bank->id)" method="POST" accept-charset="utf-8">
             {{ csrf_field() }}
             {{ method_field('DELETE') }}
               <button type="button" style="" class="btn btn-link" "><i class="fa fa-trash fa-lg text-danger"></i></a>
            </form> -->
            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
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
          </div>
          <!-- /.box-body -->
        </div>
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
            <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="268"
            data-setup='{}'>
              <source src="rtmp://10.151.36.34/{{ Auth::user()->username }}/test" type='rtmp/mp4'>
            </video>

            <div class="chat">
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