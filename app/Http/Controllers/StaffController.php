<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Staff;

class StaffController extends Controller
{
    public function index(){
        $staffs = Staff::all();
        $page_title = 'Church Staffs';
        $page_description = 'Church Staffs';
        $page_keywords = 'staffs,church workers';
        return view('pages.staffs.index',
            compact(
                'staffs','page_title',
                'page_description','page_keywords'
            ));
    }

    public function show($slug){
        $staff = Staff::findBySlugOrFail($slug);
        $handle = json_decode($staff->social_media_handle);
        $page_title = $staff->name;
        $page_description = str_limit($staff->bio, 75, '...');
        $page_keywords = $staff->name.','. $staff->position;
        return view('pages.staffs.show',
            compact(
                'staff','handle','page_title',
                'page_description','page_keywords'
            ));
    }
}
