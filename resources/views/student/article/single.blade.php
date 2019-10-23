@extends('layouts.app')
@section('title', 'Student | Notice-board | '.$article->title)
@section('content')
    <div class="con-title">
        <h2>{{$article->title}}</h2>
        <small><b>Event Date:</b> {{$article->date->format('F d, Y')}}</small>
    </div>


        <div class="pad-bot-70">
            {{ $article->content }}
        </div>
    <div>
        <a href="{{route('category', ['categories'=>$article->category->slug])}}" class="btn btn-success">BACK TO MAIN PAGE</a>
    </div>
@stop
