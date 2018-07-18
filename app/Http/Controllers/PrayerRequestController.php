<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\PrayerRequest;
class PrayerRequestController extends Controller
{
    public function create(){
        $page_title = 'Send Prayer Request';
        $page_description = 'Send Prayer request';
        $page_keywords = 'prayer,request,church';
        return view('pages.requests.index', compact(
            'staffs','page_title',
            'page_description','page_keywords'
        ));
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required',
            'phone' => 'numeric',
            'email' => 'required|email',
            'subject' => 'required|min:2|max:255',
            'message' => 'required|min:5',
        ]);
        $request = PrayerRequest::create($data);
        if(isset($request)){
            return back()->with('success', 'Your Prayer Request has been sent!.Thank you, We\'ll respond as soon as possible');
        }
        return back();
    }
}
