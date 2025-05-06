@extends('layouts.main')
@section('content')
    <div class="container"><br>
        <div>{{$post->id}}. {{$post->title}}</div>
        <div>{{$post->post_content}}</div>
        <div>{{$post->likes}}</div><br>
        <div>
            <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary">Edit</a><br>
        </div><br>
        <div>
            <form action="{{route('post.delete', $post->id)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-primary">
            </form>
        </div><br>
        <div>
            <a href="{{route('post.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
