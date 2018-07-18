<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Project;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('admin.layouts.projects.index',compact('projects'));
    }

    public function show($slug){
        $project = Project::findBySlugOrFail($slug);
        return view('admin.layouts.projects.show',compact('project'));
    }

    public function create(){
        return view('admin.layouts.project.create');
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required|min:3',
            'meta_keywords' => 'required',
            'photo' => 'required',
            'completion_date' => 'required|date',
            'status' => 'required',
            'published_at' => 'nullable|date',
        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $project = Project::create([
            'subject' => str::title($data['title']),
            'slug' => str::title($data['slug']),
            'description' => $data['description'],
            'meta_keywords' => $data['meta_keywords'],
            'photo' => $data['photo'],
            'published_at' => $published_at,
            'completion_date' => Carbon::parse($data['completion_date'])->format('Y-m-d'),
        ]);

        if($project->id != ''){
            flash()->success('success', $project->title.' project created');
            return redirect()->route('admin.projects.index');
        }
        return redirect()->back();
    }
    public function edit($slug){
        $project = Project::findBySlugOrFail($slug);
        return view('admin.layouts.projects.edit',compact('project'));
    }

    public function update(Request $request){
        $data = request()->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required|min:3',
            'meta_keywords' => 'required',
            'photo' => 'required',
            'completion_date' => 'required|date',
            'status' => 'required',
            'published_at' => 'nullable|date',
        ]);
        $published_at = '';
        if($data['status'] == 'PUBLISHED'){
            $published_at= Carbon::now();
        }elseif($data['status'] == 'PENDING'){
            $published_at = Carbon::parse($data['published_at'])->format('Y-m-d H:i');
        }
        $project = Testimony::findBySlugOrFail(request()->input('slug'));
        if($data['photo'] != $project->photo){
            $this->removePhoto($project);
        }
        $updated= $project->update([
            'subject' => str::title($data['title']),
            'slug' => str::title($data['slug']),
            'description' => $data['description'],
            'meta_keywords' => $data['meta_keywords'],
            'photo' => $data['photo'],
            'published_at' => $published_at,
            'completion_date' => Carbon::parse($data['completion_date'])->format('Y-m-d'),
        ]);

        if($updated){
            flash()->success('success', $project->title.' project updated');
            return redirect()->route('admin.projects.index');
        }
        return redirect()->back();
    }

    public function destroy($slug){
        $ids = request()->input('ids');
        if(is_array(explode(",",$ids))){
            $project = DB::table("staffs")->whereIn('id',explode(",",$ids))->delete();
            $this->removePhoto($project);
            //Testimony::destroy($ids);
            return response()->json(['success'=>"Project Deleted successfully."]);
        }else {
            $project = Project::findBySlug($slug);
            $this->removePhoto($project);
            $project->delete();
            return response()->json(['success' => "Project Deleted successfully."]);
        }
    }

    public function upload(){
        $file = request()->file;
        $strippedName = str_replace(' ', '', $file->getClientOriginalName());
        $name = date('Y-m-d-H-i-s').'-'.pathinfo($strippedName, PATHINFO_FILENAME);

        $folder = '/uploads/projects/images/';
        $small_image = Image::make($file)
            ->resize(540, 480, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);
        Storage::disk('public')->put($folder.'thumbnails/'.$name, $small_image, 'public');
        $large_image = Image::make($file)
            ->resize(960, 960, function (Constraint $constraint) {
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

    public function removePhoto($project){
        if(isset($project->photo)){
            if(File::exists(public_path('storage/uploads/projects/images/'.$project->photo))) {
                File::delete(public_path('storage/uploads/projects/images/'.$project->photo));
            }
            if(File::exists(public_path('storage/uploads/projects/images/thumbnails/'.$project->photo))) {
                File::delete(public_path('storage/uploads/projects/images/thumbnails/'.$project->photo));
            }
        }
    }

   /* public function comment(){
        $comments = Comment::where('commentable_type', 'testimonies')->latest()->get();
        return view('admin.layouts.sermon.comment',compact('comments'));
    }

    public function toggleComment(Request $request){
        $testimony = Testimony::find($request->input('id'));
        $checked = $request->get('isChecked');
        //dd($checked);
        if($checked == 'true'){
            //dd($checked);
            $update = $testimony->update([
                'allow_comments'=>false
            ]);
            // dd($update);
            return response()->json(['success' => "Comment Closed!."]);
        }else{
            //dd($checked);
            $testimony->update([
                'allow_comments'=>true
            ]);
            return response()->json(['success' => "Comment enabled!."]);
        }
    }*/
}
