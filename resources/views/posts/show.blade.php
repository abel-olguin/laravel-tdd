@extends('layouts.app')

@section('content')
    <div class="content">
        <h1>{{$post->title}}</h1>
        <p>{{$post->content}}</p>
        <small>{{$post->user->name}}</small>
    </div>

    {!! Form::open(['route' => ['comment.store',$post],'method' => 'post']) !!}

        {!! Field::textarea('comment') !!}
        {!! Form::submit('Enviar comentario') !!}
    {!! Form::close() !!}
@endsection