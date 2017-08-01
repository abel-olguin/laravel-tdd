@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @foreach($posts as $post)
        <div>
            <h1><a href="{{$post->url}}">{{$post->title}}</a></h1>
            <p>{{$post->content}}</p>
        </div>
    @endforeach

    {{$posts->render()}}
@endsection