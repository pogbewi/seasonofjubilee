<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\SermonCategory;

class SermonCategoryController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
        $categories = SermonCategory::all();
        return view('admin.layouts.sermon.category.index',compact('categories'));
    }

    public function show($slug){
        $category = SermonCategory::findBySlugOrFail($slug);
        return view('admin.layouts.sermon.category.show',compact('category'));
    }

    public function create(){
        $categories = SermonCategory::all();
        return view('admin.layouts.sermon.category.create',compact('categories'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'order' => 'numeric'
        ]);
        $category = SermonCategory::create($data);
        if($category != ''){
            flash()->success('success', 'Category created');
            return redirect()->route('admin.category.index');
        }
        return redirect()->back();
    }

    public function edit($slug){
        $categories = SermonCategory::pluck('name','id')->toArray();
        $category = SermonCategory::findBySlugOrFail($slug);
        return view('admin.layouts.sermon.category.edit',compact('categories','category'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'order' => 'numeric',
            'parent_id' => 'numeric'
        ]);
        $category = SermonCategory::findBySlugOrFail($request->input('slug'));
        $update = $category->update($data);
        if($update){
            flash()->success('success', 'Category updated');
            return redirect()->route('admin.category.index');
        }
        return redirect()->back();
    }

    public function destroy($lug, Request $request)
    {
        $ids = $request->input('ids');
        if(is_array(explode(",",$ids))){
            $category = DB::table("sermon_category")->whereIn('id',explode(",",$ids))->delete();
            //SermonCategory::destroy($ids);
            return response()->json(['success'=>"category Deleted successfully."]);
        }else {
            $category = SermonCategory::findOrFail($ids);
            $category->delete();
            return response()->json(['success' => "Category Deleted successfully."]);
        }
    }
}
