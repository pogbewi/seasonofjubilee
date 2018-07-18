<?php

namespace Seasonofjubilee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Seasonofjubilee\Http\Controllers\Controller;
use Seasonofjubilee\Models\Contact;

class ContactController extends AdminBaseController
{
    public function index(){
        $contacts = Contact::all();
        return view('admin.layouts.contact.index',compact('contacts'));
    }

    public function show($id){
        $contact = Contact::find($id);
        $contact->update([
            'read' => true
        ]);
        return view('admin.layouts.contact.show',compact('contact'));
    }

    public function destroy(){
        $ids = request()->input('ids');
        if(is_array(explode(",",$ids))){
            $contact = DB::table("contact")->whereIn('id',explode(",",$ids))->delete();
            //Contact::destroy($ids);
            return response()->json(['success'=>"Contact Deleted successfully."]);
        }else {
            $contact = Contact::findOrFail($ids);
            $contact->delete();
            return response()->json(['success' => "Contact Deleted successfully."]);
        }
    }
}
