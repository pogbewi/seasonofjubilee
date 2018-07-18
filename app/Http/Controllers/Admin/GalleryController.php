<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Logic\Ffmpeg\MyFfmpeg;
use Seasonofjubilee\Models\Gallery;
use Seasonofjubilee\Models\GalleryCategory;
use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class GalleryController extends AdminBaseController
{
    private $ffmpeg;

    public function __construct()
    {
        parent::__construct();
        $this->ffmpeg = new MyFfmpeg();

    }
    public function index(){
        $galleries = Gallery::all();
        return view('admin.layouts.gallery.index',compact('galleries'));
    }

    public function show($slug){
        $gallery = Gallery::findBySlugOrFail($slug);
        return view('admin.layouts.gallery.read',compact('gallery'));
    }

    public function create(){
        $categories = GalleryCategory::all();
        return view('admin.layouts.gallery.create',compact('galleries','categories'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required|max:255',
            'filename' => '',
            'description' => 'required|min:3',
            'size' => '',
            'url' => '',
            'type' => '',
            'embed_id' => '',
            'video_thumb' => '',
            'audio_thumb' => '',
            'gallery_type' => 'required',
            'allow_comments' => '',
            'gallery_category_id' => '',
            'published_at' => 'nullable|date',
            'tag_names' => '',
            'status' => 'required',
            'photo' => '',
            'featured' => ''
        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $gallery = Gallery::create([
            'title' => str::title($data['title']),
            'filename' => $data['filename'],
            'description' => $data['description'],
            'size' => $data['size'],
            'url' => $data['url'],
            'type' => $data['type'],
            'embed_id' => $data['embed_id'],
            'video_thumb' => $data['video_thumb'],
            'audio_thumb' => $data['audio_thumb'],
            'gallery_type' => $data['gallery_type'],
            'allow_comments' => isset($data['allow_comments'])? 1 : 0,
            'gallery_category_id' => $data['gallery_category_id'],
            'published_at' => $published_at,
            'featured' => isset($data['featured'])? true : false
        ]);

        if(isset($gallery->id)){
            $gallery->tag(strtolower($data['tag_names']));
            flash()->success('success', 'Item Added');
            return redirect()->route('admin.galleries.index');
        }
        return back();
    }

    public function edit($slug){
        $categories = GalleryCategory::pluck('name', 'id');
        $gallery = Gallery::findBySlugOrFail($slug);
        return view('admin.layouts.gallery.edit',compact('categories','gallery'));
    }

    public function update(){
        $data = request()->validate([
            'title' => 'required|max:255',
            'filename' => '',
            'description' => 'required|min:3',
            'size' => '',
            'url' => '',
            'type' => '',
            'embed_id' => '',
            'video_thumb' => '',
            'audio_thumb' => '',
            'gallery_type' => 'required',
            'allow_comments' => '',
            'published_at' => 'nullable|date',
            'tag_names' => '',
            'status' => 'required',
            'photo' => '',
            'gallery_category_id' => '',
            'featured' => '',

        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $gallery = Gallery::findBySlugOrFail(request()->input('slug'));
        if($data['filename'] != $gallery->filename){
            $this->removeGallery($gallery);
        }

        $updated = $gallery->update([
            'title' => str::title($data['title']),
            'filename' => $data['filename'],
            'description' => $data['description'],
            'size' => $data['size'],
            'url' => $data['url'],
            'type' => $data['type'],
            'embed_id' => $data['embed_id'],
            'video_thumb' => $data['video_thumb'],
            'audio_thumb' => $data['audio_thumb'],
            'gallery_type' => $data['gallery_type'],
            'allow_comments' => isset($data['allow_comments'])? 1 : 0,
            'gallery_category_id' => $data['gallery_category_id'],
            'published_at' => $published_at,
            'featured' => isset($data['featured'])? true : false
        ]);
        if($updated){
            $gallery->tag(strtolower($data['tag_names']));
            flash()->success('success', 'Item Updated');
            return redirect()->route('admin.galleries.index');
        }
        return back();
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(is_array($ids)){
            foreach($ids as $id){
                $gallery = Gallery::find($id);
                $gallery->detag();
            }
            DB::table("galleries")->whereIn('id',$ids)->get()->each(function($gallery){
                $photo_path = public_path('/storage/uploads/galleries/photos/'.$gallery->filename);
                $photo_thumb_path = public_path('/storage/uploads/galleries/photos/thumbnails/'.$gallery->filename);
                $audio_path = public_path('/storage/uploads/galleries/audios/'.$gallery->filename);
                $audio_thumb_path = public_path('/'.$gallery->audio_thumb);
                $video_path = public_path('/storage/uploads/galleries/videos/'.$gallery->filename);
                $video_thumb_path = public_path('/'.$gallery->video_thumb);
                switch($gallery->filename){
                    case File::exists($video_path):
                        File::delete($video_path);
                    case File::exists($video_thumb_path):
                        File::delete($video_thumb_path);
                    case File::exists($photo_path):
                        File::delete($photo_path);
                    case File::exists($photo_thumb_path):
                        File::delete($photo_thumb_path);
                    case File::exists($audio_path):
                        File::delete($audio_path);
                    case File::exists($audio_thumb_path):
                        File::delete($audio_thumb_path);
                        continue;
                    default:
                        break;
                }
            });
             //DB::table("galleries")->whereIn('id',$ids)->delete();
             //Gallery::destroy($ids);
            return response()->json(['success'=>"Gallery Deleted successfully."]);
        }else {
            $gallery = Gallery::findOrFail($ids);
            $this->removeGallery($gallery);
            $gallery->detag();
            $gallery->delete();
            return response()->json(['success' => "Gallery Deleted successfully."]);
        }
    }

    public function uploadPhoto(){
        $file = request()->file;
        $strippedName = str_replace(' ', '', $file->getClientOriginalName());
        $name = date('Y-m-d-H-i-s').'-'.pathinfo($strippedName, PATHINFO_FILENAME);
        $type = $file->getClientMimeType();
        $size = $file->getClientSize();
        $ext = $file->getClientOriginalExtension();

        $folder = '/uploads/galleries/photos/';
        $small_image = Image::make($file)
            ->resize(640, 460)
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.'thumbnails/'.$name.'.'.$ext, $small_image, 'public');
        $large_image = Image::make($file)
            ->resize(960, 960, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.$name.'.'.$ext, $large_image, 'public');
        $file_path = $folder.'thumbnails/'.$name.'.'.$ext;
        if(file_exists(public_path('storage/'.$folder.'thumbnails/'.$name.'.'.$ext))){
            return response()->json(['success'=>'Successfully uploaded new file!', 'file'=>$name.'.'.$ext, 'type'=>$type, 'size'=>$size, 'path'=>$file_path]);
        }
        return response()->json(['msg' => 'Unable to upload your file.']);
    }

    public function uploadVideo(){
        $file = request()->file;
        $ext = $file->getClientOriginalExtension();
        $name = date('Y-m-d-H-i-s').'-'.str_slug(pathinfo(str_limit($file->getClientOriginalName(), 15), PATHINFO_FILENAME));
        $type = $file->getClientMimeType();
        $size = $file->getClientSize();
        //dd($ext);
        $folder = '/uploads/galleries/videos/';
        Storage::disk('public')->putFileAs($folder, $file, $name.'.'.$ext, 'public');
        $ffmpeg = $this->ffmpeg->generateGalleryVideoThumbnails(public_path('/storage/uploads/galleries/videos/'.$name.'.'.$ext), $name);
        $video_thumb = '';
        //dd(File::exists(public_path('/storage/uploads/galleries/videos/'.$name)));
        if($ffmpeg){
            $video_thumb = 'storage/uploads/galleries/videos/thumbnails/'.$name.'.gif';
        }
        if(file_exists(public_path($video_thumb)) || File::exists(public_path('/storage'.$folder.$name.'.'.$ext))){
            return response()->json(['success'=>'Successfully uploaded new file!', 'file'=>$name.'.'.$ext, 'type'=>$type, 'size'=>$size, 'path'=>$video_thumb]);
        }
        return response()->json(['msg' => 'Unable to upload your file.']);
    }

    public function uploadAudio(){
        $file = request()->file;
        $ext = $file->getClientOriginalExtension();
        $name = date('Y-m-d-H-i-s').'-'.str_slug(pathinfo(str_limit($file->getClientOriginalName(), 15), PATHINFO_FILENAME));
        $type = $file->getClientMimeType();
        $size = $file->getClientSize();
        //dd($ext);
        $folder = '/uploads/galleries/audios/';
        Storage::disk('public')->putFileAs($folder, $file, $name.'.'.$ext, 'public');
        $ffmpeg = $this->ffmpeg->generateGalleryAudioThumbnails(public_path('/storage/uploads/galleries/audios/'.$name.'.'.$ext), $name);
        $audio_thumb = '';
        //dd(File::exists(public_path('/storage/uploads/galleries/videos/'.$name)));
        if($ffmpeg){
            $audio_thumb = 'storage/uploads/galleries/audios/thumbnails/'.$name.'.png';
        }
        if(file_exists(public_path($audio_thumb)) || File::exists(public_path('/storage'.$folder.$name.'.'.$ext))){
            return response()->json(['success'=>'Successfully uploaded new file!', 'file'=>$name.'.'.$ext, 'type'=>$type, 'size'=>$size, 'path'=>$audio_thumb]);
        }
        return response()->json(['msg' => 'Unable to upload your file.']);
    }

    public function removeGallery($gallery){
        if(isset($gallery->filename)){
            $photo_path = public_path('/storage/uploads/galleries/photos/'.$gallery->filename);
            $photo_thumb_path = public_path('/storage/uploads/galleries/photos/thumbnails/'.$gallery->filename);
            $audio_path = public_path('/storage/uploads/galleries/audios/'.$gallery->filename);
            $audio_thumb_path = public_path('/'.$gallery->audio_thumb);
            $video_path = public_path('/storage/uploads/galleries/videos/'.$gallery->filename);
            $video_thumb_path = public_path('/'.$gallery->video_thumb);
            switch($gallery->filename){
                case File::exists($video_path):
                    File::delete($video_path);
                case File::exists($video_thumb_path):
                    File::delete($video_thumb_path);
                case File::exists($photo_path):
                    File::delete($photo_path);
                case File::exists($photo_thumb_path):
                    File::delete($photo_thumb_path);
                case File::exists($audio_path):
                    File::delete($audio_path);
                case File::exists($audio_thumb_path):
                    File::delete($audio_thumb_path);
                    continue;
                default:
                    break;
            }
        }
    }

    public function embedUrl(){

    }
}
