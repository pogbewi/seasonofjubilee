<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Seasonofjubilee\Models\Comment;
use Seasonofjubilee\Models\Contact;
use Illuminate\Support\Facades\View;
use Seasonofjubilee\Models\PrayerRequest;
class AdminBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $user;
    protected $admin;

    public function __construct()
    {
        if(app()->runningInConsole()){
            return;
        }
        $route = app(Route::class);
        // Get the controller array
        $arr = array_reverse(explode('\\', explode('@', $route->getAction()['uses'])[0]));

        $controller = '';

        // Add folder
        if ($arr[1] != 'controllers') {
            $controller .= kebab_case($arr[1]) . '-';
        }

        // Add file
        $controller .= kebab_case($arr[0]);

        // Skip ACL
        $skip = ['admin-admin-controller'];
        if (in_array($controller, $skip)) {
            return;
        }
        //dd('permission:read-' . $controller);

        // Add CRUD permission check
        $this->middleware('permission:create-' . $controller)->only(['create', 'store']);
        $this->middleware('permission:read-' . $controller)->only(['index', 'show', 'edit']);
        $this->middleware('permission:update-' . $controller)->only(['update']);
        $this->middleware('permission:delete-' . $controller)->only('destroy');

        $message_count = Contact::where('read', false)->count();
        $prayer_requests_count = PrayerRequest::where('read', false)->count();
        $new_sermon_comment_count = Comment::where('approved', false)->where('commentable_type', 'sermons')->count();
        //dd($new_sermon_comment_count);
        $new_post_comment_count = Comment::where('approved', false)->where('commentable_type', 'posts')->count();
        $new_testimony_comment_count = Comment::where('approved', false)->where('commentable_type', 'testimonies')->count();
        View::share([
            'message_count'=>$message_count,
            'prayer_requests_count'=>$prayer_requests_count,
            'new_sermon_comment_count' => $new_sermon_comment_count,
            'new_post_comment_count' => $new_post_comment_count,
            'new_testimony_comment_count' => $new_testimony_comment_count
        ]);
    }
}

