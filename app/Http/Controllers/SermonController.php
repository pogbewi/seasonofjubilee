<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Seasonofjubilee\Models\Sermon;
use Cviebrock\EloquentTaggable\Models\Tag;
use Carbon\Carbon;
class SermonController extends Controller
{
    public function index(){
        $sermons = Sermon::with(['category','service'])->where('scheduled_on','<', Carbon::now())->orWhere('scheduled_on', Carbon::now())->latest()->paginate(10);
        //dd($sermon->media->first()->type);
        $page_title = 'Church Sermons';
        $page_description = 'Collections of Church Sermons from various programs.';
        $page_keywords = 'sermon,church,teaching,preching,messages';
        return view('pages.sermons.index',
            compact(
                'start_date','upcoming_event',
                'sermons','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($slug){
        $sermon = Sermon::findBySlug($slug);
        $latest = Sermon::where('id', '!=', $sermon->id)->latest()->take(5)->get();
        $sermon_id = 'sermon_'.$sermon->id;
        if(!Session::has($sermon_id)){
            $sermon->increment('views');
            Session::put($sermon_id, 1);
        }
        $popular = Sermon::where('views', '>', 10)->latest()->take(5)->get();
        $page_title = $sermon->title;
        $page_description = str_limit($sermon->meta_description,75,'...');
        $page_keywords = $sermon->meta_keywords;
        return view('pages.sermons.show',
            compact(
                'sermon','latest','popular',
                'page_title','page_description',
                'page_keywords'
            ));
    }

    public function viewPDF($file){
        $path = 'storage/media/upload/sermon/pdf/'.$file;
        return response()->file($path,['Content-Type', 'application/pdf']);
    }

    public function pdfDownload($file){
        $path = 'storage/media/upload/sermon/pdf/'.$file;
        return response()->download($path,200, ['Content-Type', 'application/pdf']);
    }

    public function tagSermons($slug){
        $sermons = Tag::findByName($slug)->sermons->paginate(10);
        //dd($events->forPage(1, 1));
        $page_title = 'Tag Sermons';
        $page_description = 'Sermons associated with'.Tag::findByName($slug)->name;
        $page_keywords = Tag::findByName($slug)->name;
        return view('pages.sermons.tags',
            compact(
                'sermons', 'slug','page_title',
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

        $sermon = Sermon::findBySlugOrFail(request()->input('slug'));
        $query = $sermon->comments()->create([
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
