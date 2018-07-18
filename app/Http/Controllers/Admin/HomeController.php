<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Post;
use Seasonofjubilee\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Seasonofjubilee\Models\Event;
use Carbon\Carbon;
use Seasonofjubilee\Models\Admin;
use Seasonofjubilee\Models\Sermon;
use Seasonofjubilee\Models\Testimony;

class HomeController extends AdminBaseController
{
    public function index()
    {
        $event_count = Event::where('start_date', '>=', Carbon::now() )->count();
        $admin_count = $admins = Admin::count();
        $sermon_count = Sermon::with(['category','service'])->where('scheduled_on','<', Carbon::now())->orWhere('scheduled_on', Carbon::now())->count();
        $post_count = Post::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->count();
        $testimony_count = Testimony::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->count();
        return view('admin.index',
            compact(
                'event_count','admin_count','sermon_count',
                'post_count','testimony_count'
            ));
    }

    public function subscriber(){
        $subscribers = Subscriber::all();
        return view('admin.layouts.subscriber.index',compact('subscribers'));
    }

    public function deleteSubscriber(Request $request){
        $ids = $request->get('ids');
        if(is_array(explode(',', $ids))){
            DB::table("subscribers")->whereIn('id',explode(',', $ids))->delete();
            return response()->json(['success'=>"Subscribers Deleted successfully."]);
        }else {
            $subscriber = Subscriber::findOrFail($ids);
            $subscriber->delete();
            return response()->json(['success' => "Subscriber Deleted successfully."]);
        }
    }
}
