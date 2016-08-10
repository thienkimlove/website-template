@extends('layouts.app')

@section('content')
    <h1>
        Example View Composer
    </h1>
    @foreach ($posts as $post)
        <p>
            {{$post->title}}
        </p>
    @endforeach
    {!! $posts->links() !!}
@endsection