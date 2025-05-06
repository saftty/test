@extends('layouts.main')
@section('content')
    <br>
    <div class="container">
        <div>
            <a href="{{route('post.create')}}" class="btn btn-primary">Add one</a>
        </div>
        <br>

        @foreach($posts as $post)
            <div><a href="{{route('post.show', $post->id)}}">{{$post->id}}. {{$post->title}}</a></div>
        @endforeach<br>

        <div>
            {{$posts->withQueryString()->links()}}
        </div>
    </div>
    <br>
@endsection
