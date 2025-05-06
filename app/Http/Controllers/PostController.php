<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use App\Models\Post;


class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        //TODO validation to request
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => 'required|exists:categories,id',
            'tags' => ''
        ]);

        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post): View
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);

        return redirect()->route('post.show', $post->id);
    }

//    public function delete(): void
//    {
//        $post = Post::withTrashed()->find(2);
//        $post->restore();
//        dd('deleted post');
//    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
    public function firstOrCreate(): void
    {
        $somePost = [
            'title' => 'title PHPStorm',
            'content' => '=content som=',
            'image' => 'some image',
            'likes' => 200,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => $somePost['title'],
        ], $somePost);
        dump($post->content);
        dd('firstOrCreate');
    }

    public function updateOrCreate(): void
    {
        $anotherSomePost = [
            'title' => 'title PHPStorm',
            'content' => 'uupdated some content',
            'image' => 'uupdated image',
            'likes' => 50000,
            'is_published' => 1,
        ];
        $post = Post::updateOrCreate([
            'title' => $anotherSomePost['title'],
        ], $anotherSomePost);
        dump($post->content);
        dd('updateOrCreate');
    }
}
