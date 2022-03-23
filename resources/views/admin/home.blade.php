@extends('admin.layouts.nav')
@section('content')
    @auth()
        <h1> this is home admin page, welcome {{ Auth::user()->name }}</h1>
    @endauth
@endsection
