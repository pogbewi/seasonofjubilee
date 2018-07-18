<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Admin;
use Seasonofjubilee\Models\Role;
use Seasonofjubilee\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class AdminController extends AdminBaseController
{
    public function index(){
        $admins = Admin::with('roles')->get();
        $roles = Role::all();
        return view('admin.layouts.admins.index',compact('admins','roles'));
    }

    public function show($id){
        $admin = Admin::find($id);
        return view('admin.layouts.admins.show',compact('admin'));
    }

    public function edit(){
        $admin = Auth::guard('admin')->user();
        $roles = Role::pluck('name','id');
        return view('admin.layouts.admins.edit',compact('admin','roles'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'photo' => 'string',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $admin = Admin::find($request->input('id'));
        if($data['photo'] != $admin->avatar){
            $this->removePhoto($admin);
        }
        $updated = $admin->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'avatar' => $data['photo'],
            'password' => $data['password'] ? bcrypt($data['password']) : $admin->password,
        ]);
        //dd($data);
        if($updated){
            flash()->success('success', 'Profile Updated');
            return back();
        }
        if(isset($data['avatar'])){
            if(File::exists(public_path('storage/uploads/admin/photos/'.$data['avatar']))) {
                File::delete(public_path('storage/uploads/admin/photos/'.$data['avatar']));
            }
            if(File::exists(public_path('storage/uploads/admin/photos/thumbnails/'.$data['avatar']))) {
                File::delete(public_path('storage/uploads/admin/photos/thumbnails/'.$data['avatar']));
            }
        }
        return back();
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(isset($ids)){
            $admin = Admin::findOrFail($ids);
            $this->removePhoto($admin);
            $admin->delete();
            return response()->json(['success' => "Admin Deleted successfully."]);
        }
        return response()->json(['error' => "Ooops unable to delete.Try again."]);
    }

    public function upload(){
        $file = request()->file;
        $strippedName = str_replace(' ', '', $file->getClientOriginalName());
        $name = date('Y-m-d-H-i-s').'-'.pathinfo($strippedName, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();

        $folder = '/uploads/admin/photos/';
        $small_image = Image::make($file)
            ->resize(180, 180, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.'thumbnails/'.$name.'.'.$ext, $small_image, 'public');
        $large_image = Image::make($file)
            ->resize(270, 270, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.$name.'.'.$ext, $large_image, 'public');
        $file_path = $folder.'thumbnails/'.$name.'.'.$ext;
        if(file_exists(public_path('storage/'.$folder.'thumbnails/'.$name.'.'.$ext))){
            return response()->json(['success'=>'Successfully uploaded new file!', 'file'=>$name.'.'.$ext, 'path'=>$file_path]);
        }
        return response()->json(['msg' => 'Unable to upload your file.']);
    }

    public function removePhoto($admin){
        if(isset($admin->photo)){
            if(File::exists(public_path('storage/uploads/admin/photos/'.$admin->avatar))) {
                File::delete(public_path('storage/uploads/admin/photos/'.$admin->avatar));
            }
            if(File::exists(public_path('storage/uploads/admin/photos/thumbnails/'.$admin->avatar))) {
                File::delete(public_path('storage/uploads/admin/photos/thumbnails/'.$admin->avatar));
            }
        }
    }
}
