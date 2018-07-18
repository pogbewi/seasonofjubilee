<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\GalleryCategory;
class GalleryCategoryController extends AdminBaseController
{

    public function index(){
        $categories = GalleryCategory::all();
        return view('admin.layouts.gallery.category.index',compact('categories'));
    }

    public function show($slug){
        $category = GalleryCategory::findBySlugOrFail($slug);
        return view('admin.layouts.gallery.category.show',compact('category'));
    }

    public function create(){
        $categories = GalleryCategory::all();
        return view('admin.layouts.gallery.category.create',compact('categories'));
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required',
            'order' => 'numeric'
        ]);
        $category = GalleryCategory::create($data);
        if(isset($category)){
            flash()->success('success', 'Category created');
            return redirect()->route('admin.gallery-categories.index');
        }
        return redirect()->back();
    }

    public function edit($slug){
        $categories = GalleryCategory::pluck('name','id')->toArray();
        $category = GalleryCategory::findBySlugOrFail($slug);
        return view('admin.layouts.gallery.category.edit',compact('categories','category'));
    }

    public function update(){
        $data = request()->validate([
            'name' => 'required',
            'order' => 'numeric',
            'parent_id' => 'numeric'
        ]);
        $category = GalleryCategory::findBySlugOrFail(request()->input('slug'));
        $update = $category->update($data);
        if($update){
            flash()->success('success', 'Category updated');
            return redirect()->route('admin.gallery-categories.index');
        }
        return redirect()->back();
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(is_array(explode(",",$ids))){
            $category = DB::table("sermon_category")->whereIn('id',explode(",",$ids))->delete();
            //GalleryCategory::destroy($ids);
            return response()->json(['success'=>"category Deleted successfully."]);
        }else {
            $category = GalleryCategory::findOrFail($ids);
            $category->delete();
            return response()->json(['success' => "Category Deleted successfully."]);
        }
    }
}
