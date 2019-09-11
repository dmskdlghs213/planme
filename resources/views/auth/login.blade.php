@extends('layout')


@section('content')
<html>

<head>

  <link rel=stylesheet href="/css/login.css">
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <h1>Login</h1>
      <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $message)
          <p>{{ $message }}</p>
          @endforeach
        </div>
        @endif

        <form class="form" action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="EMAIL" />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" />
          </div>
          <button type="submit" id="login-button">Login</button>
        </form>
        <div class="text-center">
          <a　style="position: relative;" href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
        </div>
      </div>

      <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>

  </div>

</body>
<script>
  $("#login-button").click(function(event) {
    event.preventDefault();

    $('form').fadeOut(500);
    $('.wrapper').addClass('form-success');
  });
</script>


</html>

@endsection