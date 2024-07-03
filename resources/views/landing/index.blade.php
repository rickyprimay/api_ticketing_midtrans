@extends('auth.layouts.app')

@section('content')
    @if (auth()->check())
        <p>Welcome, {{ auth()->user()->name }}</p>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn bg-red-400">Logout</button>
        </form>
    @else
        <a href="{{ route('auth.login') }}" class="btn bg-blue-500 rounded">Login</a>
        <a href="{{ route('auth.register') }}" class="btn bg-blue-600 rounded">Register</a>
    @endif
@endsection
