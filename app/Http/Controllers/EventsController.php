<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Event;
use Carbon\Carbon;
use Cviebrock\EloquentTaggable\Models\Tag;
use Seasonofjubilee\Models\EventRegistration;

class EventsController extends Controller
{
    public function index(Request $request){
        $events = Event::where('end_date', '<=', Carbon::now())->orWhere('start_date', '>=', Carbon::now())->latest()->paginate(10);
        //dd($events);
        $page_title = 'Upcoming Church Events';
        $page_description = 'Upcoming Church Events';
        $page_keywords = 'Events,Latest Events,popular events,upcoming events';
        return view('pages.events.index',
            compact('events','page_title','page_description',
                'page_keywords'
            ))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function pastEvents(Request $request){
        $past_events = Event::where('end_date', '<', Carbon::now())->latest()->paginate(10);
        //dd($past_events);
        $page_title = 'Previous Church Events';
        $page_description = 'Previous Church Events';
        $page_keywords = 'Events,Latest Events,popular events,previous events';
        return view('pages.events.past-events',
            compact('past_events','page_title','page_description',
                'page_keywords'
            ))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function show($slug){
        $event = Event::findBySlugOrFail($slug);
        $page_title = $event->name;
        $page_description = str_limit($event->description, 75, '...');
        $page_keywords = 'events';
        return view('pages.events.show',
            compact('event','page_title','page_description',
                'page_keywords'
            ));
    }

    public function tagEvents($slug){
        $events = Tag::findByName($slug)->events->paginate(10);
        $page_title = 'Tag Events';
        $page_description = 'Events associated with Tag'.Tag::findByName($slug)->name;
        $page_keywords = Tag::findByName($slug)->name;
        return view('pages.events.tags',
            compact('events', 'slug','page_title',
                'page_description','page_keywords'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function storeRegister(Request $request){
        //dd($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'phone' => 'required|numeric|min:5',
            'gender' => 'required',
            'attend' => 'nullable',
            'seat' => 'required_if:attend,true'
        ]);

        $reg = EventRegistration::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'attend' => $data['attend'] ? 1 : 0,
            'seat' => $data['seat'],
        ]);
        if($reg->id != ''){
            return response()->json(['success'=>'Registered successful'], 200);
        }
        return response()->json();
    }

}
