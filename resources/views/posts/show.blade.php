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

    @foreach($post->latest_comments as $comment)
        <article class="{{$comment->answer?'answer':''}}">
            {{$comment->comment}}
        </article>
        -{{$comment->user->name}}
        @php
            //@can('accept',$comment)
        @endphp

        @if(Gate::allows('accept',$comment) && !$comment->answer)
            {!! Form::open(['route' => ['comment.accept',$comment],'method' => 'post'])  !!}
                {!! Form::submit('Aceptar respuesta') !!}
            {!! Form::close() !!}
        @endif
    @endforeach
@endsection