<?php

namespace Seasonofjubilee\Jobs;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Pbmedia\LaravelFFMpeg\FFMpegFacade;
use Seasonofjubilee\Logic\Ffmpeg\MyFfmpeg;
use Seasonofjubilee\Models\Event;
use Illuminate\Support\Facades\Storage;
class convertEventVideosForStreams implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $event;

    public $path;
    public $ffmpeg;
    public $name;

    public function __construct($event, $name)
    {
        $this->event = $event;
        $this->name = $name;
        $this->ffmpeg = new MyFfmpeg();
/*
        $this->path = '/temp/events/' . $event->filename . '.' . $event->ext;*/

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->ffmpeg->generateVideoThumbnails(storage_path('app/public/uploads/events/files/'.$this->event->filename), $this->name, $this->event);

/*        dd($this->path);
        //create some video formats...
        $folder = 'public/uploads/events/files';
        //open the uploaded video from the right disk...

         FFMpegFacade::open($this->path)
            ->addFilter(function ($filters) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            })
            ->export()
            ->inFormat((new X264())->setAudioCodec("libmp3lame"))
            ->save('steve_howe.mp4');


        $this->event->update([
            'filename' => $this->event->filename,
            'size' => Storage::size('public/uploads/events/files/'.$this->event->filename.'.'.$this->event->ext),
            'ext' => 'mp4',
            'image_url' => Storage::url('public/uploads/events/files/'.$this->event->filename.'.'.$this->event->ext),
        ]);
        //FFMpegFacade::cleanupTemporaryFiles();*/

    }
}
