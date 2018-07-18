<?php
/**
 * Created by PhpStorm.
 * User: Esther
 * Date: 3/14/2018
 * Time: 3:19 PM
 */

namespace Seasonofjubilee\Http;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
class CustomImage
{
    public function generateImageThumb($path,$width=null,$height=null,$type='fit'){
        $images_path = 'storage';
        $path = ltrim($path, '/');

        if(is_null($width) && is_null($height)){
            return url("{$images_path}/".$path);
        }

        if(File::exists(public_path("{$images_path}/thumbs/"."{$width}X{$height}/".$path))){
            return url("{$images_path}/thumbs/"."{$width}X{$height}/".$path);
        }
        if(!File::exists(public_path("{$images_path}/".$path))){
            return "http://placehold.it/{$width}X{$height}";
        }

        $allowedMimeTypes = ['image/jpeg','image/gif','image/png'];
        $contentType = mime_content_type("{$images_path}/".$path);
        if(in_array($contentType,$allowedMimeTypes)){
            $image = Image::make(public_path("{$images_path}/".$path));
            switch($type){
                case "fit":
                    $image->fit($width,$height,function($constraint){
                        $constraint->upsize();
                    });
                    break;
                case "resize":
                    $image->resize($width,$height);
                    break;
                case "background":
                    $image->resize($width,$height,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    break;
                case "resizeCanvas":
                    $image->resizeCanvas($width,$height,'center',false,'rgba(0,0,0,0)');
            }
            $dir_path = (dirname($path) == '.') ? "" : dirname($path);
            if(!File::exists(public_path("{$images_path}/thumbs/"."{$width}X{$height}/".$dir_path))){
                File::makeDirectory(public_path("{$images_path}/thumbs/"."{$width}X{$height}/".$dir_path),0775,true);
            }
            $image->save(public_path("{$images_path}/thumbs/"."{$width}X{$height}/".$path));
            return url("{$images_path}/thumbs/"."{$width}X{$height}/".$path);
        }else{
            return "http://placehold.it/{$width}X{$height}";
        }
    }
}