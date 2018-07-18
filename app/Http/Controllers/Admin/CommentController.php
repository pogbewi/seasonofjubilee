<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Comment;
use Seasonofjubilee\Models\Sermon;
use Illuminate\Support\Facades\DB;
class CommentController extends AdminBaseController
{
    public function index(){

    }

    public function show($id){
        $comment = Comment::find($id);
        return view('admin.layouts.comment.read',compact('comment'));
    }

    public function create(){
        return back();
    }

    public function store(){
        return back();
    }

    public function edit(){
        return back();
    }

    public function update(Request $request){
        $comment = Comment::find($request->input('id'));
        $update = $comment->update([
            'approved' => true
        ]);
        if($update){
            return response()->json(['success' => "Comment Approved!."]);
        }
        return response()->json(['error' => "ouch!,Error Occured,Try again."]);
    }

    public function destroy(Request $request){
        $ids = $request->input('ids');
        if(is_array(explode(",",$ids))){
            DB::table("comments")->whereIn('id',explode(",",$ids))->get()->delete();
            return response()->json(['success'=>"Sermon Deleted successfully."]);
        }else {
            $comment = Comment::find($ids);
            if ($comment->delet()) {
                return response()->json(['success' => "Comment Deleted!."]);
            }
            return response()->json(['error' => "ouch!,Error Occured,Try again."]);
        }
    }
}
