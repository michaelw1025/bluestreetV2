@extends('layouts.app')

@section('content')

    <form class="form-signin" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}


        <h2 class="form-signin-heading">Please Login</h2>

        <span class="{{ $errors->has('email') ? 'has-error' : '' }}"></span>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="form-text"><strong>{{ $errors->first('email') }}</strong></span>
        @endif      

        <span class="{{ $errors->has('password') ? 'has-error' : '' }}"></span>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control mt-2" placeholder="Password" name="password" required>
        @if ($errors->has('email'))
            <span class="form-text"><strong>{{ $errors->first('password') }}</strong></span>
        @endif

        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
          </label>
        </div> -->


        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">Forget Password</a> -->


    </form>

@endsection
