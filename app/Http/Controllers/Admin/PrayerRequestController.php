<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\PrayerRequest;
use Illuminate\Support\Facades\DB;
class PrayerRequestController extends AdminBaseController
{
    public function index(){
        $requests = PrayerRequest::all();
        $page_title = 'View All Prayer Requests';
        $page_description = 'Prayer request From page visitors';
        $page_keywords = 'prayer,request,church, users,vidtors';
        return view('admin.layouts.requests.index',
            compact(
                'requests','staffs','page_title',
                'page_description','page_keywords'
            ));
    }

    public function show($id){
        $request = PrayerRequest::find($id);
        $request->update([
            'read' => true
        ]);

        $page_title = $request->subject;
        $page_description = str_limit($request->message, 75, '...');
        $page_keywords = 'prayer,request,church, users,vidtors';
        return view('admin.layouts.requests.show',
            compact('request','staffs','page_title',
                'page_description','page_keywords'
            ));
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

    public function update(){
        return back();
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(is_array(explode(",",$ids))){
            DB::table("contact")->whereIn('id', explode(",",$ids))->delete();
            return response()->json(['success'=>"Prayer Request(s) Deleted successfully."]);
        }else {
            $request = PrayerRequest::findOrFail($ids);
            $request->delete();
            return response()->json(['success' => "Prayer Request Deleted successfully."]);
        }
    }
}
