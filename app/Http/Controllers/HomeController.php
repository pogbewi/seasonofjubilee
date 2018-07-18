<?php

namespace Seasonofjubilee\Http\Controllers;

use Illuminate\Http\Request;
use Seasonofjubilee\Models\Contact;
use Seasonofjubilee\Models\Event;
use Carbon\Carbon;
use Seasonofjubilee\Models\Gallery;
use Seasonofjubilee\Models\Post;
use Seasonofjubilee\Models\Project;
use Seasonofjubilee\Models\Sermon;
use Seasonofjubilee\Models\Staff;
use Seasonofjubilee\Models\Subscriber;
use Seasonofjubilee\Models\Testimony;

class HomeController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        $upcoming_event = Event::where('end_date', '>=', Carbon::now())->orWhere('start_date', '>=', Carbon::now())->orWhere('start_date', '<=', Carbon::now())->latest()->first();
        if(!is_null($upcoming_event)){
            $start_date = Carbon::parse($upcoming_event->start_date)->format('m/d/Y H:i:s');
            //dd($start_date);
        }
        $past_events = Event::where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->latest()->take(5)->get();
        //dd($past_events);
        $sermons = Sermon::with(['category','service'])->where('scheduled_on','<', Carbon::now())->orWhere('scheduled_on', Carbon::now())->latest()->paginate(4);
        $testimonies = Testimony::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(5)->get();

        $projects = Project::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(5)->get();

        $posts = Post::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(10)->get();

        $staffs = Staff::where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(10)->get();
        $handle = [];
        foreach($staffs as $staff){
            $handle = json_decode($staff->social_media_handle);
        }
        $photo_galleries = Gallery::where('gallery_type','photo')->where('featured', false)->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(4)->get();
        $featured_photo = Gallery::where('gallery_type','photo')->where('featured', true)->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->first();
        $video_galleries =  Gallery::where('gallery_type','video')->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now())->latest()->take(7)->get();
        //dd($featured_photo);

        $page_title = '';
        $page_description = 'Welcome';
        $page_keywords = '';
        return view('index',compact('start_date','upcoming_event','past_events',
            'sermons','testimonies','projects','staffs','handle','posts',
            'photo_galleries','video_galleries','featured_photo','page_title',
            'page_description','page_keywords'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function about(){
        $page_title = 'About Us';
        $page_description = 'About us,Who we are ';
        $page_keywords = 'About us, who we are';
        return view('pages.about',compact('page_title','page_description','page_keywords'));
    }

    public function give(){
        $page_title = 'Frequently Ask Questions';
        $page_description = 'Frequently ask questions';
        $page_keywords = 'question';
        return view('pages.give.index',compact('page_title','page_description','page_keywords'));
    }

    public function contact(){
        $page_title = 'Contact Us';
        $page_description = 'Contact us';
        $page_keywords = 'contact,our contacts';
        return view('pages.contact',compact('page_title','page_description','page_keywords'));
    }

    public function postContact(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'phone' => 'numeric',
            'email' => 'required|email',
            'subject' => 'required|min:2|max:255',
            'message' => 'required|min:5',
        ]);
        $contact = Contact::create($data);
        if(isset($contact)){
            return back()->with('success', 'Your message has been sent!.Thank you, We\'ll respond as soon as possible');
        }
        return back();
    }

    public function subscribe(Request $request){
        $data = $request->validate([
            'name' => '',
            'email' => 'required | email'
        ]);

        $subscriber = Subscriber::create($data);
        if(isset($subscriber->id)){
            return back()->with('success', 'Subscription successful, You will start receiving updates from us soon');
        }
        return back();
    }

    public function getUnsubscribe(){
        $page_title = 'Contact Us';
        $page_description = 'Contact us';
        $page_keywords = 'contact,our contacts';
        return view('emails.unsubscribed',compact('page_title','page_description','page_keywords'));
    }

    public function unsubscribe(Request $request){
        $email = $request->input('email');
        if($email != ''){
            $subscriber = Subscriber::where('email', $email)->first();
            if($subscriber != ''){
                $subscriber->delete();
                return back()->with('unsubscriber-success', 'Your email has been removed from our system,you can re-add again at anytime');
            }
            return back()->with('error', 'Gush!,Email not in our system');
        }
        return back();
    }

}
