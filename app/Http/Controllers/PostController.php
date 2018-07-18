<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentTaggable\Models\Tag;
class PostController extends Controller
{
    public function index(){
        $posts = Post::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $popular = Post::where('views', '>', 10)->latest()->take(5)->get();
        //dd($sermon->media->first()->type);
        $page_title = 'Church Blog Posts';
        $page_description = 'church blog posts';
        $page_keywords = 'blog,posts,inspirational,teaching,upliftment,development';
        return view('pages.posts.index',
            compact(
                'posts','popular','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($slug){
        $post = Post::findBySlugOrFail($slug);
        $post_id = 'testimony_'.$post->id;
        if(!Session::has($post_id)){
            $post->increment('views');
            Session::put($post_id, 1);
        }
        $popular = Post::where('views', '>', 10)->latest()->take(5)->get();
        $latest = Post::where('id', '!=', $post->id)->latest()->take(5)->get();
        $page_title = $post->title;
        $page_description = str_limit($post->meta_description, 75, '...');
        $page_keywords = $post->meta_keywords;
        return view('pages.posts.show',
            compact(
                'post','popular','latest',
                'page_title','page_description','page_keywords'
            ));
    }

    public function tag($slug){
        $posts = Tag::findByName($slug)->posts->paginate(10);
        $page_title = 'Tag Posts';
        $page_description = 'Posts associated with'.Tag::findByName($slug)->name;
        $page_keywords = Tag::findByName($slug)->name;
        return view('pages.posts.tags',
            compact(
                'posts', 'slug','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function comment(){
        $data = request()->validate([
            'name' => '',
            'email' => '',
            'body' => 'required',
        ]);
        //dd(request()->all());

        $post = Post::findBySlugOrFail(request()->input('slug'));
        $query = $post->comments()->create([
            'name' => $data['name'] ? $data['name'] : 'anonymous',
            'email' => $data['email'],
            'body' => $data['body']
        ]);
        if($query){
            return back()->with('success', 'Your comment Posted, waiting for moderation.Thank you!');
        }
        return back();
    }
}
