<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Gallery;
use Carbon\Carbon;
use Seasonofjubilee\Models\GalleryCategory;
use Illuminate\Support\Facades\Session;
class GalleryController extends Controller
{
    public function photo_index(){
        $categories = GalleryCategory::all();
        $photo_galleries =  Gallery::where('gallery_type','photo')->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $page_title = 'Church Photo Gallery';
        $page_description = 'Pictures From Church events,activities';
        $page_keywords = 'church,pictures,photos,images,gallery';
        return view('pages.gallery.photos.index',
            compact('photo_galleries','categories',
                'page_title','page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function audio_index(){
        $categories = GalleryCategory::all();
        $audio_galleries =  Gallery::where('gallery_type','audio')->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $page_title = 'Church Audio Gallery';
        $page_description = 'Collections of Audio Teachings';
        $page_keywords = 'audio,sermon,teachings,gallery';
        return view('pages.gallery.audios.index',
            compact('audio_galleries','categories',
                'page_title','page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function video_index(){
        $categories = GalleryCategory::all();
        $video_galleries =  Gallery::where('gallery_type','video')->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $page_title = 'Church video Gallery';
        $page_description = 'Collections of video messages,teachings';
        $page_keywords = 'video,messages,teachings,sermons,gallery';
        return view('pages.gallery.videos.index',
            compact('video_galleries','categories',
                'page_title','page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function video_show($slug){
        $categories = GalleryCategory::all();
        $gallery=  Gallery::findBySlugOrFail($slug);
        $gallery_id = 'gallery_'.$gallery->id;
        if(!Session::has($gallery_id)){
            $gallery->increment('views');
            Session::put($gallery_id, 1);
        }
        $popular =  Gallery::where('gallery_type','video')->where('views', '>', 10)->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(4);
        $latest =  Gallery::where('gallery_type','video')->where('id', '!=', $gallery->id)->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(4);
        $page_title = $gallery->title;
        $page_description = str_limit($gallery->description, 75, '...');
        $page_keywords = 'video';
        return view('pages.gallery.videos.show',
            compact('latest','popular','gallery','categories',
                'page_title','page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function embedded_index(){
        $embedded_galleries =  Gallery::where('gallery_type','embedded')->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $embed = json_encode($embedded_galleries);
        $page_title = 'Youtube and vimeo videos';
        $page_description = 'Videos from our vimeo and youtube channels';
        $page_keywords = 'youtube,vimeo,video,embedded';
        return view('pages.gallery.embed.index',
            compact('embedded_galleries','embed',
                'page_title','page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function download($slug){
        $gallery = Gallery::findBySlugOrFail($slug);
        $gallery_id = 'gallery_download_'.$gallery->id;
        if(!Session::has($gallery_id)){
            $gallery->increment('download_count');
            Session::put($gallery_id, 1);
        }
        $gallery->update([
            'last_download_time'=> Carbon::now()
        ]);
            if($gallery->gallery_type == 'video'){
                $path = 'storage/uploads/galleries/videos/'.$gallery->filename;
                return response()->download($path,$gallery->slug, ['Content-Type', 'video/mp4']);
            }elseif($gallery->gallery_type == 'audio'){
                $path = 'storage/uploads/galleries/audios/'.$gallery->filename;
                return response()->download($path,$gallery->slug, ['Content-Type', 'media/audio']);
            }
        return "";

    }

}
