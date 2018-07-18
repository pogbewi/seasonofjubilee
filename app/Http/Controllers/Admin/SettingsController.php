<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Http\Controllers\Admin\AdminBaseController;
use Seasonofjubilee\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
class SettingsController extends AdminBaseController
{
    public function index(){
        $settings = Setting::all();
        //dd($settings);
        return view('admin.layouts.settings.index', compact('settings'));
    }

    public function update(Request $request){
        $settings = Setting::all();
        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType($request, 'settings', (object) [
                'type'    => $setting->type,
                'field'   => $setting->key,
                'details' => $setting->details,
            ]);

            if ($content === null && isset($setting->value)) {
                $content = $setting->value;
            }

            $setting->value = $content;
            $setting->save();
        }
        flash()->success('success','Settings Saved successfully');
        return redirect()->back();
    }

    public function upload(Request $request){

    }


    public function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }

                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;

                break;

            /********** FILE TYPE **********/
            case 'file':
                if ($file = $request->file($row->field)) {
                    $filename = Str::random(20);
                    $path = $slug.'/'.date('F').date('Y').'/';
                    $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
                    $request->file($row->field)->storeAs(
                        $path,
                        $filename.'.'.$file->getClientOriginalExtension(),
                        'public'
                    );

                    return $fullPath;
                }
            // no break

            /********** MULTIPLE IMAGES TYPE **********/
            case 'multiple_images':
                if ($files = $request->file($row->field)) {
                    /**
                     * upload files.
                     */
                    $filesPath = [];
                    foreach ($files as $key => $file) {
                        $filename = Str::random(20);
                        $path = $slug.'/'.date('F').date('Y').'/';
                        array_push($filesPath, $path.$filename.'.'.$file->getClientOriginalExtension());
                        $filePath = $path.$filename.'.'.$file->getClientOriginalExtension();
                        $options = json_decode($row->details);

                        if (isset($options->resize) && isset($options->resize->width) && isset($options->resize->height)) {
                            $resize_width = $options->resize->width;
                            $resize_height = $options->resize->height;
                        } else {
                            $resize_width = 1800;
                            $resize_height = null;
                        }

                        $image = Image::make($file)->resize($resize_width, $resize_height,
                            function (Constraint $constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })->encode($file->getClientOriginalExtension(), 75);

                        Storage::disk(config('savysoft.storage.disk'))->put($filePath, (string) $image, config('savysoft.storage.disk'));

                        if (isset($options->thumbnails)) {
                            foreach ($options->thumbnails as $thumbnails) {
                                if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                                    $scale = intval($thumbnails->scale) / 100;
                                    $thumb_resize_width = $resize_width;
                                    $thumb_resize_height = $resize_height;

                                    if ($thumb_resize_width != 'null') {
                                        $thumb_resize_width = $thumb_resize_width * $scale;
                                    }

                                    if ($thumb_resize_height != 'null') {
                                        $thumb_resize_height = $thumb_resize_height * $scale;
                                    }

                                    $image = Image::make($file)->resize($thumb_resize_width, $thumb_resize_height,
                                        function (Constraint $constraint) {
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })->encode($file->getClientOriginalExtension(), 75);
                                } elseif (isset($options->thumbnails) && isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                                    $crop_width = $thumbnails->crop->width;
                                    $crop_height = $thumbnails->crop->height;
                                    $image = Image::make($file)
                                        ->fit($crop_width, $crop_height)
                                        ->encode($file->getClientOriginalExtension(), 75);
                                }

                                Storage::disk(config('savysoft.storage.disk'))->put($path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension(),
                                    (string) $image, config('savysoft.storage.disk')
                                );
                            }
                        }
                    }

                    return json_encode($filesPath);
                }
                break;

            /********** SELECT MULTIPLE TYPE **********/
            case 'select_multiple':
                $content = $request->input($row->field);

                if ($content === null) {
                    $content = [];
                } else {
                    // Check if we need to parse the editablePivotFields to update fields in the corresponding pivot table
                    $options = json_decode($row->details);
                    if (isset($options->relationship) && !empty($options->relationship->editablePivotFields)) {
                        $pivotContent = [];
                        // Read all values for fields in pivot tables from the request
                        foreach ($options->relationship->editablePivotFields as $pivotField) {
                            if (!isset($pivotContent[$pivotField])) {
                                $pivotContent[$pivotField] = [];
                            }
                            $pivotContent[$pivotField] = $request->input('pivot_'.$pivotField);
                        }
                        // Create a new content array for updating pivot table
                        $newContent = [];
                        foreach ($content as $contentIndex => $contentValue) {
                            $newContent[$contentValue] = [];
                            foreach ($pivotContent as $pivotContentKey => $value) {
                                $newContent[$contentValue][$pivotContentKey] = $value[$contentIndex];
                            }
                        }
                        $content = $newContent;
                    }
                }

                return $content;

            /********** IMAGE TYPE **********/
            case 'image':
                if ($request->hasFile($row->field)) {
                    $file = $request->file($row->field);
                    $filename = Str::random(20);

                    $path = $slug.'/'.date('F').date('Y').'/';

                    $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

                    $options = json_decode($row->details);

                    if (isset($options->resize) && isset($options->resize->width) && isset($options->resize->height)) {
                        $resize_width = $options->resize->width;
                        $resize_height = $options->resize->height;
                    } else {
                        $resize_width = 1800;
                        $resize_height = null;
                    }

                    $image = Image::make($file)->resize($resize_width, $resize_height,
                        function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->encode($file->getClientOriginalExtension(), 75);

                    Storage::disk(config('savysoft.storage.disk'))->put($fullPath, (string) $image, config('savysoft.storage.disk'));

                    if (isset($options->thumbnails)) {
                        foreach ($options->thumbnails as $thumbnails) {
                            if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                                $scale = intval($thumbnails->scale) / 100;
                                $thumb_resize_width = $resize_width;
                                $thumb_resize_height = $resize_height;

                                if ($thumb_resize_width != 'null') {
                                    $thumb_resize_width = $thumb_resize_width * $scale;
                                }

                                if ($thumb_resize_height != 'null') {
                                    $thumb_resize_height = $thumb_resize_height * $scale;
                                }

                                $image = Image::make($file)->resize($thumb_resize_width, $thumb_resize_height,
                                    function (Constraint $constraint) {
                                        $constraint->aspectRatio();
                                        $constraint->upsize();
                                    })->encode($file->getClientOriginalExtension(), 75);
                            } elseif (isset($options->thumbnails) && isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                                $crop_width = $thumbnails->crop->width;
                                $crop_height = $thumbnails->crop->height;
                                $image = Image::make($file)
                                    ->fit($crop_width, $crop_height)
                                    ->encode($file->getClientOriginalExtension(), 75);
                            }

                            Storage::disk(config('savysoft.storage.disk'))->put($path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension(),
                                (string) $image, config('savysoft.storage.disk')
                            );
                        }
                    }

                    return $fullPath;
                }
                break;

            /********** TIMESTAMP TYPE **********/
            case 'timestamp':
                if ($request->isMethod('PUT')) {
                    if (empty($request->input($row->field))) {
                        $content = null;
                    } else {
                        $content = gmdate('Y-m-d H:i:s', strtotime($request->input($row->field)));
                    }
                }
                break;

            /********** ALL OTHER TEXT TYPE **********/
            default:
                $value = $request->input($row->field);
                $options = json_decode($row->details);
                if (isset($options->null)) {
                    return $value == $options->null ? null : $value;
                }

                return $value;
        }

        return $content;
    }

    public function delete_value($id)
    {
        $setting = Setting::find($id);
        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            if ($setting->type == 'image') {
                $this->deleteCustomThumbs($setting->value);
                if (Storage::disk(config('savysoft.storage.disk'))->exists($setting->value)) {
                    Storage::disk(config('savysoft.storage.disk'))->delete($setting->value);
                    File::cleanDirectory(public_path('storage/thumbs'), true);
                }
            }
            $setting->value = '';
            $setting->save();
        }

        return back();
    }

}
