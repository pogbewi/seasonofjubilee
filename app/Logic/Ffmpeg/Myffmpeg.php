<?php
 namespace Seasonofjubilee\Logic\Ffmpeg;


 use FFMpeg\Coordinate\Dimension;
 use FFMpeg\Coordinate\TimeCode;
 use FFMpeg\FFMpeg;
 use FFMpeg\Filters\Video\ResizeFilter;
 use FFMpeg\Format\Video\WebM;
 use FFMpeg\Format\Video\X264;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Facades\File;
 use Seasonofjubilee\Models\Event;

 class MyFfmpeg
{
    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @return void
     * @link http://php.net/manual/en/language.oop5.decon.php
     */
    private $ffmpeg;

    function __construct()
    {
        $this->ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('savysoft.ffmpeg_variables.ffmpeg'),
            'ffprobe.binaries' => config('savysoft.ffmpeg_variables.ffprobe'),
            'timeout'          => 7200, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);
    }

    public function generateVideoThumbnails($path, $name, $event){
        if (!file_exists(public_path('storage/uploads/events/files/'))) {
            mkdir(public_path('storage/uploads/events/files/'), @777, true);
        }
        $video_thumb = $this->ffmpeg->open($path);
        $video_thumb->gif(TimeCode::fromSeconds(4), new Dimension(640,480), 3)
            ->save(public_path('storage/uploads/events/files/'.$name.'.gif'));
        $image = 'storage/uploads/events/files/'.$name.'.gif';

        Event::findBySlugOrFail($event->slug)->update([
            'video_thumb' =>$image
        ]);

    }

     public function generateSermonVideoThumbnails($path, $name){
         if (!file_exists(public_path('storage/media/upload/sermon/video/'))) {
             mkdir(public_path('storage/media/upload/sermon/video/'), @777, true);
         }
         $video_thumb = $this->ffmpeg->open($path);
         $video_thumb->gif(TimeCode::fromSeconds(4), new Dimension(640,480), 3)
             ->save(public_path('storage/media/upload/sermon/video/'.$name.'.gif'));
         if(file_exists('storage/media/upload/sermon/video/'.$name.'.gif')){
             return true;
         }
         return false;
     }

    public function optimizeVideoMp4($file, $name){
        $folder = 'uploads/events/files';
        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), @777, true);
        }
        $video = $this->ffmpeg->open($file);
        $format = new X264();
        $format
            ->setAudioCodec("libmp3lame");
        $video
            ->filters()
            ->resize(new Dimension(640, 480))
            ->synchronize();
        $video
            ->save($format, ($folder.'/'.$name.'.mp4'));
        $path = File::move(public_path($folder.'/'.$name.'.mp4'), storage_path('app/public/'));
        return $video;
    }

     public function generateGalleryVideoThumbnails($path, $name){
         //dd(file_exists($path));
         if (!file_exists(public_path('storage/uploads/galleries/videos/thumbnails'))) {
             mkdir(public_path('storage/uploads/galleries/videos/thumbnails/'), @777, true);
         }
         $video_thumb = $this->ffmpeg->open($path);
         $video_thumb->gif(TimeCode::fromSeconds(4), new Dimension(640,480), 5)
             ->save(public_path('storage/uploads/galleries/videos/thumbnails/'.$name.'.gif'));
         if(File::exists(public_path('/storage/uploads/galleries/videos/thumbnails/'.$name.'.gif'))){
             return true;
         }
         return false;
     }

     public function generateGalleryAudioThumbnails($path, $name){
         //dd(file_exists($path));
         if (!file_exists(public_path('storage/uploads/galleries/audios/thumbnails'))) {
             mkdir(public_path('storage/uploads/galleries/audios/thumbnails/'), @777, true);
         }
         $waveform = $this->ffmpeg->open($path);
         $waveform = $waveform->waveform()
             ->save(public_path('storage/uploads/galleries/audios/thumbnails/'.$name.'.png'));
         if(File::exists(public_path('/storage/uploads/galleries/audios/thumbnails/'.$name.'.png'))){
             return true;
         }
         return false;
     }

}