<!doctype html>
  <html>
    <head>
      <title>Chat Application</title>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel='stylesheet' href="{{ URL::asset('/TChat/style.css') }}" type='text/css'/>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
      <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
      <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
      <script src="{{ URL::asset('/TChat/chat.js') }}"></script>
    </head>

  <body>
    <ul id="messages"></ul>
    <span id="notifyUser"></span>
    <form id="form" action="" onsubmit=" return submitfunction();" >
      <input type="hidden" id="user" value="" />
      <input style="width: 60%; border:0px; padding:10px 5%" id="m" autocomplete="off" onkeyup="notifyTyping();" placeholder="Say something..." />
      <button type="submit" id="button" value="Send">Send</button>
    </form>



  </body>
</html>
