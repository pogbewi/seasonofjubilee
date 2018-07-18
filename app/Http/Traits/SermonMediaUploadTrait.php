<?php
/**
 * Created by PhpStorm.
 * User: Esther
 * Date: 2/10/2018
 * Time: 2:54 AM
 */

namespace Seasonofjubilee\Http\Traits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;
trait SermonMediaUploadTrait
{
    public function uploadImage($file, $fileName){
        $folder = 'sermon/images/';
        $small_image = Image::make($file)
            ->resize(640, 640, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('media')->put($folder.'thumbnails/'.$fileName, $small_image, 'public');

        $large_image = Image::make($file)
            ->resize(960, 960, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('media')->put($folder.$fileName, $large_image, 'public');
    }

    public function uploadVideo($file, $fileName){
        Storage::disk('media')->putFileAs('sermon/video', $file, $fileName, 'public');
    }

    public function uploadAudio($file, $fileName){
        Storage::disk('media')->putFileAs('sermon/audio', $file, $fileName, 'public');
    }

    public function uploadPdf($file, $fileName){
        Storage::disk('media')->putFileAs('sermon/pdf', $file, $fileName, 'public');
    }
}