@extends('layout')

<head>
  <link rel="stylesheet" href="/css/login.css">
</head>
@section('content')
<html>

<body>

  <div class="wrapper">
    <div class="container">
      <h1>Register</h1>
      <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $message)
          <p>{{ $message }}</p>
          @endforeach
        </div>
        @endif


        <form action="{{ route('register') }}" method="POST">
          @csrf

          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name" />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Password confirmation">
          </div>
          <div class="text-center">
            <button type="submit" id="login-button">go</button>
          </div>

        </form>

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


</html>


@endsection