@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Easy Car Enterprise</h1>

        <a href="{{ route('register') }}">
            <h3>Register here</h3>
        </a>
        <a href="{{ route('login') }}">
            <h3>Login here</h3>
        </a>
    </div>
@endsection
