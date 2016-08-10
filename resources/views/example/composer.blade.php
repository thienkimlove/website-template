@extends('layouts.app')

@section('content')
    <h1>
        Example View Composer
    </h1>
    @foreach ($latestPosts as $post)
    <p>
        {{$post->title}}
    </p>
    @endforeach

@endsection