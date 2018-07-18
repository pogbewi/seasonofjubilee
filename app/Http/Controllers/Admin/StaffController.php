<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Staff;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
class StaffController extends Controller
{
    public function index(){
        $staffs = Staff::all();
        return view('admin.layouts.staffs.index',compact('staffs'));
    }

    public function show($slug){
        $staff = Staff::findBySlugOrFail($slug);
        $handle = json_decode($staff->social_media_handle);
        return view('admin.layouts.staffs.read',compact('staff','handle'));
    }

    public function create(){
        return view('admin.layouts.staffs.create');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required|max:255',
            'bio' => 'required',
            'position' => 'required',
            'photo' => 'required',
            'published_at' => 'nullable|date',
            'status' => 'required',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => ''
        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $social_media = [
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'instagram' => $data['instagram'],
            'linkedin' => $data['linkedin']
        ];

        $staff = Staff::create([
            'name' => $data['name'],
            'bio' => $data['bio'],
            'position' => $data['position'],
            'avatar' => $data['photo'],
            'social_media_handle' => json_encode($social_media),
            'published_at' => $published_at
        ]);

        if(isset($staff->id)){
            flash()->success('success', 'Staff Added');
            return redirect()->route('admin.staffs.index');
        }
        return back();
    }

    public function edit($slug){
        $staff = Staff::findBySlugOrFail($slug);
        $social_handle = json_decode($staff->social_media_handle);
        return view('admin.layouts.staffs.edit',compact('staff','social_handle'));
    }

    public function update(){
        $data = request()->validate([
            'name' => 'required|max:255', 'bio' => 'required',
            'position' => 'required',
            'photo' => '',
            'published_at' => 'nullable|date',
            'status' => 'required',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => ''
        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $social_media = [
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'instagram' => $data['instagram'],
            'linkedin' => $data['linkedin']
        ];
        $staff = Staff::findBySlugOrFail(request()->input('slug'));
        if($data['photo'] != $staff->avatar){
            $this->removePhoto($staff);
        }
        $updated = $staff->update([
            'name' => $data['name'],
            'bio' => $data['bio'],
            'position' => $data['position'],
            'avatar' => $data['photo'],
            'social_media_handle' => json_encode($social_media),
            'published_at' => $published_at
        ]);

        if($updated){
            flash()->success('success', 'Staff Updated');
            return redirect()->route('admin.staffs.index');
        }
        return back();
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(is_array(explode(",",$ids))){
            $staff = DB::table("staffs")->whereIn('id',explode(",",$ids))->delete();
            $this->removePhoto($staff);
            //Staff::destroy($ids);
            return response()->json(['success'=>"Staff Deleted successfully."]);
        }else {
            $staff = Staff::findOrFail($ids);
            $this->removePhoto($staff);
            $staff->delete();
            return response()->json(['success' => "Staff Deleted successfully."]);
        }
    }

    public function upload(){
        $file = request()->file;
        $strippedName = str_replace(' ', '', $file->getClientOriginalName());
        $name = date('Y-m-d-H-i-s').'-'.pathinfo($strippedName, PATHINFO_FILENAME);

        $folder = '/uploads/staffs/photos/';
        $small_image = Image::make($file)
            ->resize(180, 180, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.'thumbnails/'.$name, $small_image, 'public');
        $large_image = Image::make($file)
            ->resize(270, 270, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.$name, $large_image, 'public');
        $file_path = $folder.'thumbnails/'.$name;
        if(file_exists(public_path('storage/'.$folder.'thumbnails/'.$name))){
            return response()->json(['success'=>'Successfully uploaded new file!', 'file'=>$name, 'path'=>$file_path]);
        }
        return response()->json(['msg' => 'Unable to upload your file.']);
    }

    public function removePhoto($staff){
        if(isset($staff->photo)){
            if(File::exists(public_path('storage/uploads/staffs/photos/'.$staff->avatar))) {
                File::delete(public_path('storage/uploads/staffs/photos/'.$staff->avatar));
            }
            if(File::exists(public_path('storage/uploads/staffs/photos/thumbnails/'.$staff->avatar))) {
                File::delete(public_path('storage/uploads/staffs/photos/thumbnails/'.$staff->avatar));
            }
        }
    }
}
