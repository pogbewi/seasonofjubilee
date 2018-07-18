<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Testimony;
use Carbon\Carbon;
use Seasonofjubilee\Models\Sermon;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentTaggable\Models\Tag;
class TestimonyController extends Controller
{
    public function index(){
        $testimonies = Testimony::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $page_title = 'Testimonies';
        $page_description = 'Testimonies From Individuals';
        $page_keywords = 'testimonies,miracles,upliftment,promotions,blessings,graced';
        return view('pages.testimony.index',
            compact(
                'testimonies','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($slug){
        $testimony = Testimony::findBySlugOrFail($slug);
        $testimony_id = 'testimony_'.$testimony->id;
        if(!Session::has($testimony_id)){
            $testimony->increment('views');
            Session::put($testimony_id, 1);
        }
        $popular = Testimony::where('views', '>', 10)->latest()->take(5)->get();
        $latest = Testimony::where('id', '!=', $testimony->id)->latest()->take(5)->get();
        $page_title = $testimony->subject;
        $page_description = str_limit($testimony->meta_description, 75, '...');
        $page_keywords = $testimony->meta_keywords;
        return view('pages.testimony.show',
            compact(
                'testimony', 'popular','latest',
                'page_title','page_description',
                'page_keywords'
            ));
    }

    public function tag($slug){
        $testimonies = Tag::findByName($slug)->testimonies->paginate(10);
        //dd($events->forPage(1, 1));
        $page_title = 'Tag Testimonies';
        $page_description = 'Testimonies associated with'.Tag::findByName($slug)->name;
        $page_keywords = Tag::findByName($slug)->name;
        return view('pages.testimony.tags',compact('testimonies',
            'slug','page_title','page_description','page_keywords'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function comment(){
        $data = request()->validate([
            'name' => '',
            'email' => '',
            'body' => 'required',
        ]);
        //dd(request()->all());

        $testimony = Testimony::findBySlugOrFail(request()->input('slug'));
        $query = $testimony->comments()->create([
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
