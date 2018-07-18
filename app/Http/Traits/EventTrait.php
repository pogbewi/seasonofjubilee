<?php

namespace Seasonofjubilee\Http\Traits;

use Intervention\Image\ImageManagerStatic as Image;
use Seasonofjubilee\Models\Event;
use Illuminate\Support\Facades\Storage;
trait EventTrait
{
    public static function saveEventMedia($request, $slug)
    {
        $event_media = request()->file('file');
        $fileName = uniqid() . '.' . $event_media->getClientOriginalExtension();
        if (file_exists($event_media) && in_array($event_media->guessClientExtension(), ['jpeg', 'jpg', 'png', 'gif'])) {
            $folder = 'uploads/events/images/';
            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), @755, true);
            }
             $thumbnail = Image::make($event_media)
                ->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path($folder).$fileName);
            return public_path($folder).$fileName;
        }elseif(file_exists($event_media) && in_array($event_media->guessClientExtension(), ['mov', 'flv', 'mp4', 'mpeg'])) {
            $folder = 'uploads/events/files/'.$fileName;
            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), @755, true);
            }
            $path = Storage::disk('local')->put($folder, $event_media);
            return $path;
        }
        return null;
    }


    public function removeMediaFromEvent($slug)
    {
        $event = Event::findBySlug($slug);
    }
}