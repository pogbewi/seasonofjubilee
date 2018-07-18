<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Carbon\Carbon;

use Cviebrock\EloquentTaggable\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Pbmedia\LaravelFFMpeg\FFMpegFacade;
use Seasonofjubilee\Http\Traits\EventTrait;
use Seasonofjubilee\Jobs\convertEventVideosForStreams;
use Seasonofjubilee\Logic\Ffmpeg\MyFfmpeg;
use Seasonofjubilee\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Constraint;
use Seasonofjubilee\Events\NewsLetter;
use Seasonofjubilee\Models\EventRegistration;

class EventsController extends AdminBaseController
{
    use EventTrait;
    private $event_model;

    private $ffmpeg;

    public function __construct(Event $event_model)
    {
        parent::__construct();
        $this->event_model = $event_model;

        $this->ffmpeg = new MyFfmpeg();
    }


    public function index(){
        //mkdir(public_path('storage/uploads/events/files'), @777, true);
       // dd(public_path('uploads/events/files/5a72d30865b45_osai-and-helen-s-wedding.mp4'));
        //dd(File::copy(public_path('uploads/events/files/5a72d30865b45_osai-and-helen-s-wedding.mp4'),public_path('storage')));
        $events = Event::latest('created_at')->get();
        $ffmpeg = new MyFfmpeg();
       // dd($ffmpeg);
        return view('admin.layouts.events.index',compact('events'));
    }

    public function show($slug){
        $event = Event::findBySlugOrFail($slug);
        return view('admin.layouts.events.show',compact('event'));
    }


    public function create(){
        return view('admin.layouts.events.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'phone' => 'numeric|min:11',
            'email' => 'min:5',
            'website' => 'min:5',
            'registrable' => '',
            'tag_names' => 'string'

        ]);

       $event = Event::create([
           'name' => title_case($data['name']),
           'address' => $data['address'],
           'description' => $data['description'],
           'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d H:i'),
           'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d H:i'),
           'phone' => $data['phone'],
           'email' => $data['email'],
           'website' => $data['website'],
           'registrable' => $request->input('registrable') ? 1 : 0,
       ]);
        if($event->id != ''){
            $event->tag(strtolower($data['tag_names']));
            flash()->success('success', $event->name.'event created');
            event(new NewsLetter($event, 'event'));
            return redirect()->route('admin.events.index');
        }
        return redirect()->back();
    }

    public function edit($slug){
        $event = Event::findBySlugOrFail($slug);
        return view('admin.layouts.events.edit', compact('event'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'phone' => 'numeric|min:11',
            'email' => 'min:5',
            'website' => 'min:11',
            'registrable' => '',
            'tag_names' => 'string'
        ]);

        $event = Event::findBySlugOrFail($request->input('slug'));
        $update = $event->update([
            'name' => title_case($data['name']),
            'address' => $data['address'],
            'description' => $data['description'],
            'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d H:i'),
            'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d H:i'),
            'phone' => $data['phone'],
            'email' => $data['email'],
            'website' => $data['website'],
            'registrable' => $request->input('registrable') ? 1 : 0,
        ]);

        if($update){
            $event->retag(strtolower($data['tag_names']));
            flash()->success('success', 'Event Updated');
            return redirect()->route('admin.events.index');
        }
        return redirect()->back();
    }

    public function destroy(Request $request){
        $ids = $request->input('ids');
        if(is_array(explode(",",$ids))){
            $event = DB::table("events")->whereIn('id',explode(",",$ids))->delete();

            $this->removeEventMedia($event);
            $event->detag();
                return response()->json(['success'=>"Event Deleted successfully."]);
        }else {
            $event = Event::findOrFail($ids);
            $this->removeEventMedia($event);
            $event->delete();
            $event->detag();
            return response()->json(['success' => "Event Deleted successfully."]);
        }
    }

    private function removeEventMedia($event){
        if(($event->type ==  'video/mp4')){
            if(File::exists(storage_path('app/public/uploads/events/files/'.$event->filename))) {
                File::delete(storage_path('app/public/uploads/events/files/'.$event->filename));
            }
            if(File::exists(public_path($event->video_thumb))) {
                File::delete(public_path($event->video_thumb));
            }
        }elseif(in_array($event->type, ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'])){
            if(File::exists(storage_path('app/public/uploads/events/images/'.$event->filename))) {
                File::delete(storage_path('app/public/uploads/events/images/'.$event->filename));
            }
            if(File::exists(storage_path('app/public/uploads/events/images/thumbnails/'.$event->filename))) {
                File::delete(storage_path('app/public/uploads/events/images/thumbnails/'.$event->filename));
            }
        }
    }

    public function getMediaUpload($slug){
        $event = Event::findBySlugOrFail($slug);
        $events = Event::all();
        return view('admin.layouts.events.upload',compact('event','events'));
    }

    public function addMedia(Request $request, $slug){
        $file = $request->file('file');
        $name = uniqid().'_'.$slug;
        $fileName = $name.'.'.$file->getClientOriginalExtension();
        $event = Event::findBySlugOrFail($slug);
        if (file_exists($file) && in_array($file->guessClientExtension(), ['jpeg', 'jpg', 'png', 'gif'])) {
            $this->removeEventMedia($event);
            $folder = 'public/uploads/events/images/';
            $small_image = Image::make($file)
                ->resize(640, 460)
                ->encode($file->getClientOriginalExtension(), 75);
             Storage::disk('local')->put($folder.'thumbnails/'.$fileName, $small_image, 'public');

            $large_image = Image::make($file)
                ->resize(960, 960, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 75);
            Storage::disk('local')->put($folder.$fileName, $large_image, 'public');
            //dd(Storage::disk('media')->url($folder.$fileName));
            $update = $event->update([
                'size' => $file->getClientSize(),
                'type' => $file->getClientMimeType(),
                'filename' => $fileName
            ]);
            if($update){
                return response()->json('Uploaded Successfully');
            }
        }elseif(file_exists($file) && ($file->getClientMimeType() ==  'video/mp4')) {
            if($event->filename != ''){
             $this->removeEventMedia($event);
            }
            Storage::disk('local')->putFileAs('public/uploads/events/files', $file, $fileName);
             $event->update([
                 'type' => $file->getClientMimeType(),
                 'size' => $file->getClientSize(),
                'filename' => $fileName,
            ]);
            $this->ffmpeg->generateVideoThumbnails(storage_path('app/public/uploads/events/files/'.$event->filename), $name, $event);
            //dd(File::exists(storage_path('app/public/uploads/events/files/'.$event->filename)));
            //$job = (new convertEventVideosForStreams($event, $name))->onQueue('high');
             //   $this->dispatch($job);
            return response()->json('Uploaded Successfully');
        }
        //dd($file->getClientMimeType() );
      return response()->json('file Type not allow, only mp4 for videos is allowed');
    }

    public function deleteMedia($slug)
    {
        $event = Event::findBySlugOrFail($slug);
        if(file_exists($event->path) && file_exists($event->image_url)) {
            Storage::disk('public')->delete([$event->path, $event->image_url]);
        }
        $event->path = '';
        $event->size = '';
        $event->type = '';
        $event->filename = '';
        $event->image_url = '';
        $event->save();
        flash()->success('success', 'Item Deleted Successfully');
        return redirect()->back();
    }

    public function registration(){
        $regs = EventRegistration::all();
        return view('admin.layouts.events.registration.index',compact('regs'));
    }

    public function regDetails($id){
        $reg = EventRegistration::find($id);
        return view('admin.layouts.events.registration.read',compact('reg'));
    }

    public function deleteEventReg(Request $request){
        $ids = $request->input('ids');
        if(is_array(explode(",",$ids))){
            $reg = DB::table("event_registration")->whereIn('id',explode(",",$ids))->delete();
            return response()->json(['success'=>"Event Registration Deleted successfully."]);
        }else {
            $reg = EventRegistration::findOrFail($ids);
            $reg->delete();
            return response()->json(['success' => "Event Registrations Deleted successfully."]);
        }
    }

    public function toExcel(Request $request){
        $ids = $request->input('ids');
        //dd($ids);
        $regs = DB::table('event_registration')->whereIn('id', $ids)->get();
        $regData = [];
        foreach ($regs as $reg) {

            $regData[] = [
                'ID' => $reg->id,
                'Name' => $reg->name,
                'Email' => $reg->email,
                'Phone' => $reg->phone,
                'Gender' => $reg->gender,
                'attend' => $reg->attend,
                'seat' => $reg->seat,
            ];
        }
        // Generate and return the spreadsheet
       return Excel::create('event-registration', function ($excel) use ($regData) {

            // Build the spreadsheet, passing in the users array
            $excel->sheet('sheet1', function ($sheet) use ($regData) {
                $sheet->fromArray($regData);
            });

        })->download('xlsx');
    }
}
