<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Logic\Ffmpeg\MyFfmpeg;
use Seasonofjubilee\Models\Media;
use Seasonofjubilee\Models\Sermon;
use Seasonofjubilee\Models\SermonCategory;
use Seasonofjubilee\Models\Service;
use Illuminate\Support\Str;
use Seasonofjubilee\Http\Traits\SermonMediaUploadTrait;
use Seasonofjubilee\Models\Comment;
use Illuminate\Support\Facades\DB;
use Seasonofjubilee\Events\NewsLetter;
class SermonController extends AdminBaseController
{
    use SermonMediaUploadTrait;

    private $ffmpeg;

    public function __construct()
    {
        parent::__construct();
        $this->ffmpeg = new MyFfmpeg();

    }
    public function index(){
        $sermons = Sermon::all();
        return view('admin.layouts.sermon.index',compact('sermons'));
    }

    public function show($slug){
        $sermon = Sermon::findBySlugOrFail($slug);
        return view('admin.layouts.sermon.show',compact('sermon'));
    }

    public function create(){
        $categories = SermonCategory::all();
        $services = Service::all();
        return view('admin.layouts.sermon.create',compact('categories','services'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required|max:255|min:3',
            'body' => 'required|min:3',
            'excerpt' => 'required|min:3',
            'meta_description' => 'required|min:3',
            'meta_keywords' => 'required',
            'preacher' => 'required|max:255|min:3',
            'preached_on' => 'required',
            'sermon_category_id' => 'required',
            'tag_names' => 'string',
            'service_id' => 'required',
            'status' => 'required',
            'scheduled_on' =>'',
            'free' => '',
            'allow_comments' => ''
        ]);
         //dd($request->all());
        if($data['status'] == 'PUBLISHED'){
            $scheduled = Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $scheduled = Carbon::parse($data['scheduled_on'])->format('Y-m-d H:i');
        }else{
            $scheduled = '';
        }
        $sermon = Sermon::create([
            'title' => str::title($data['title']),
            'body' => $data['body'],
            'excerpt' => $data['excerpt'],
            'meta_description' => $data['meta_description'],
            'meta_keywords' => $data['meta_keywords'],
            'preacher' => $data['preacher'],
            'preached_on' => Carbon::parse($data['preached_on'])->format('Y-m-d'),
            'sermon_category_id' => $data['sermon_category_id'],
            'service_id' => $data['service_id'],
            'scheduled_on' => $scheduled,
            'free' => request()->input('free') ? 1:0,
            'allow_comments' => request()->input('allow_comments')?1:0
        ]);

        if(isset($sermon->id)){
            $sermon->tag(strtolower($data['tag_names']));
            flash()->success('success', $sermon->title.' sermon created');
            event(new NewsLetter($sermon, 'sermon'));
            return redirect()->route('admin.sermon.index');
        }
        return redirect()->back();
    }

    public function edit($slug){
        $sermon = Sermon::findBySlugOrFail($slug);
        $categories = SermonCategory::all();
        $services = Service::all();
        return view('admin.layouts.sermon.edit', compact('sermon','categories','services'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'title' => 'required|max:255|min:3',
            'body' => 'required|min:3',
            'excerpt' => 'required|min:3',
            'meta_description' => 'required|min:3',
            'meta_keywords' => 'required',
            'preacher' => 'required|max:255|min:3',
            'preached_on' => 'required',
            'sermon_category_id' => 'required',
            'tag_names' => 'string',
            'service_id' => 'required',
            'status' => 'required',
            'scheduled_on' =>'',
            'free' => '',
            'allow_comments' => ''
        ]);
        //dd($data);
        if($data['status'] == 'PUBLISHED'){
            $scheduled = Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $scheduled = Carbon::parse($data['scheduled_on'])->format('Y-m-d H:i');
        }else{
            $scheduled = '';
        }
        $sermon = Sermon::findBySlugOrFail(request()->input('slug'));
        $update = $sermon->update([
            'title' => str::title($data['title']),
            'body' => $data['body'],
            'excerpt' => $data['excerpt'],
            'meta_description' => $data['meta_description'],
            'meta_keywords' => $data['meta_keywords'],
            'preacher' => $data['preacher'],
            'preached_on' => Carbon::parse($data['preached_on'])->format('Y-m-d'),
            'sermon_category_id' => $data['sermon_category_id'],
            'service_id' => $data['service_id'],
            'scheduled_on' => $scheduled,
            'free' => $data['free']?1:0,
            'allow_comments' => $request->input('allow_comments')?1:0
        ]);

        if($update){
            $sermon->tag(strtolower($data['tag_names']));
            flash()->success('success', $sermon->title.' sermon updated');
            return redirect()->route('admin.sermon.index');
        }
        return redirect()->back();
    }

    public function getMediaUpload($slug){
        $sermon = Sermon::findBySlugOrFail($slug);
        $sermons = Sermon::all();
        return view('admin.layouts.sermon.upload',compact('sermon','sermons'));
    }

    public function saveYVMedia(Request $request){


            $sermon = Sermon::find($request->get('id'));
            if($sermon != ''){
                if($sermon->media() != ''){

                    if(!empty($sermon->media->first()) && ($sermon->media->first()->url != '')){
                        $media = Media::find($sermon->media->first()->id);
                        $update = $media->update([
                            'url'=> $request->get('url'),
                            'video_thumb' => $request->get('image_url')
                        ]);
                        //$sermon->media()->sync([]);
                        $sermon->media()->sync($update);
                        return response()->json(['success'=>"Media Added."]);
                    }else{
                        $sermon->media()->create([
                            'url'=> $request->get('url'),
                            'video_thumb' => $request->get('image_url')
                        ]);
                        return response()->json(['success'=>"Media Added."]);
                    }
                }
            }

        return response()->json(['error'=>"Gush! Error Occured."]);
    }

    public function addMedia(Request $request, $slug){
        $file = $request->file('file');
        $name = uniqid().'_'.$slug;
        $fileName = $name.'.'.$file->getClientOriginalExtension();
        $size = $file->getClientSize();
        $type = $file->getClientMimeType();
        $video_thumb = '';
        if(file_exists($file) && in_array($file->guessClientExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
            $this->uploadImage($file, $fileName);
        }elseif(file_exists($file) && ($file->getClientMimeType() ==  'video/mp4')){
            $this->uploadVideo($file, $fileName);
            $fMpeg = $this->ffmpeg->generateSermonVideoThumbnails(storage_path('app/public/media/upload/sermon/video/'.$fileName), $name);
            if($fMpeg){
                $video_thumb = 'storage/media/upload/sermon/video/'.$name.'.gif';
            }
        }elseif(file_exists($file) && ($file->getClientMimeType() ==  'application/pdf')){
            $this->uploadPdf($file, $fileName);
        }elseif(file_exists($file) && in_array($file->guessClientExtension(), ['mp3', 'acc', 'wma', 'mpga'])){
            $this->uploadAudio($file, $fileName);
        }
        $sermon = Sermon::findBySlugOrFail($slug);
        if($sermon != ''){
            if($sermon->media() != ''){
                    $sermon->media()->create([
                        'size'=> $size,
                        'type' => $type,
                        'filename' => $fileName,
                        'video_thumb' => $video_thumb
                    ]);
                    return response()->json(['success'=>"Media Added."]);
            }
        }
        return redirect()->back();
    }

    public function destroy(Request $request){
        $ids = $request->input('ids');
        if(is_array(explode(",",$ids))){
            $sermon = DB::table("sermons")->whereIn('id',explode(",",$ids))->delete();

            //$this->removeEventMedia($sermon);
           // Sermon::destroy($ids);
            $sermon->detag();
            return response()->json(['success'=>"Sermon Deleted successfully."]);
        }else {
            $sermon = Sermon::findOrFail($ids);
            //$this->removeEventMedia($sermon);
            $sermon->delete();
            $sermon->detag();
            $sermon->media()->sync([]);
            return response()->json(['success' => "Sermon Deleted successfully."]);
        }
    }

    public function DeleteUploadedMedia(){
        $id = request('id');
        if(isset($id)){
            $media = Media::find($id);
            if(in_array($media->type, ['image/jpeg','image/jpg'])){
                if(file_exists(storage_path('storage/media/upload/sermon/images'.$media->filename))){
                    Storage::disk('media')->delete(['sermon/images/'.$media->filename,'sermon/images/thumbnails/'.$media->filename]);
                }
            }elseif(in_array($media->type, ['video/mp4'])){

            }elseif(in_array($media->type, ['application/pdf'])){

            }elseif(in_array($media->type, ['audio/mpeg'])){

            }
            $deleted = $media->delete($media->id);
            if($deleted){
                return response()->json(['success' => "Media Item Deleted successfully."]);
            }
            return response()->json(['error' => "Error Occured,Try again."]);
        }
        return response()->json(['error' => "Error Occured,Try again."]);
    }

    public function comment(){
        $comments = Comment::where('commentable_type', 'sermons')->latest()->get();
        return view('admin.layouts.sermon.comment',compact('comments'));
    }

    public function toggleComment(Request $request){
        $sermon = Sermon::find($request->input('id'));
        $checked = $request->get('isChecked');
        //dd($checked);
        if($checked == 'true'){
            //dd($checked);
            $update = $sermon->update([
                'allow_comments'=>false
            ]);
           // dd($update);
            return response()->json(['success' => "Comment Closed!."]);
        }else{
            //dd($checked);
            $sermon->update([
                'allow_comments'=>true
            ]);
            return response()->json(['success' => "Comment enabled!."]);
        }
    }
}
