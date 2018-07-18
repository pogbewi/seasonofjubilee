<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->paginate(10);
        $page_title = 'church Projects';
        $page_description = 'Church projects';
        $page_keywords = 'church projects';
        return view('pages.projects.index',
            compact(
                'projects','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($slug){
        $project = Project::findBySlugOrFail($slug);
        $project_id = 'testimony_'.$project->id;
        if(!Session::has($project_id)){
            $project->increment('views');
            Session::put($project_id, 1);
        }
        $popular = Project::where('views', '>', 10)->latest()->take(5)->get();
        $latest = Project::where('id', '!=', $project->id)->latest()->take(5)->get();
        $page_title = $project->title;
        $page_description = str_limit($project->description, 75, '...');
        $page_keywords = $project->meta_keywords;
        return view('pages.projects.show',
            compact(
                'project', 'popular','latest',
                'page_title','page_description',
                'page_keywords'
            ));
    }
}
