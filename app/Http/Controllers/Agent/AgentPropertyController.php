<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyMessage;
use App\Models\State;
use App\Models\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduleMail;
use App\Mail\ScheduleConfirmed;
use App\Models\amenities; // Add this line


class AgentPropertyController extends Controller
{
    public function AgentAllProperty(){
        $id = Auth::user()->id;
        $property = Property::where('agent_id', $id)->latest()->get();
        return view('agent.property.all_property', compact('property'));
    } 

    public function AgentAddProperty(){
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $pstate = State::latest()->get();
        return view('agent.property.add_property',compact('propertytype','amenities','pstate'));    }

    public function AgentStoreProperty(Request $request){
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);
        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/property/thambnail'), $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'status' => 1,
            'property_thambnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/property/multi-image'), $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;
            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $facilities = count($request->facility_name);
        if ($facilities != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentEditProperty($id){
        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $multiImage = MultiImage::where('property_id', $id)->get();
        $propertytype = PropertyType::latest()->get();
        $pstate = State::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.edit_property',compact('property','propertytype','amenities','property_ami','multiImage','facilities','pstate'));    }

    public function AgentUpdateProperty(Request $request){
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentUpdatePropertyThambnail(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/property/thambnail'), $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;

        if (file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }

        Property::findOrFail($pro_id)->update([
            'property_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Image Thambnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentUpdatePropertyMultiimage(Request $request){
        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink(public_path($imgDel->photo_name));

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/property/multi-image'), $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentPropertyMultiimgDelete($id){
        $oldImg = MultiImage::findOrFail($id);
        unlink(public_path($oldImg->photo_name));
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentStoreNewMultiimage(Request $request){
        $new_multi = $request->imageid;
        $image = $request->file('multi_img');
        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/property/multi-image'), $make_name);
        $uploadPath = 'upload/property/multi-image/' . $make_name;

        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Multi Image Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentDeleteProperty($id){
        $property = Property::findOrFail($id);
        unlink(public_path($property->property_thambnail));
        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink(public_path($img->photo_name));
            MultiImage::where('property_id', $id)->delete();
        }

        $facilitiesData = Facility::where('property_id', $id)->get();
        foreach ($facilitiesData as $item) {
            Facility::where('property_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AgentDetailsProperty($id){
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $multiImage = MultiImage::where('property_id',$id)->get();
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.details_property',compact('property','propertytype','amenities','property_ami','multiImage','facilities'));
    }// End Met
    

    public function AgentInactiveProperty($id){
        Property::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Property Inactive Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentActiveProperty($id){
        Property::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Property Active Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AgentPropertyMessage(){

        $id = Auth::user()->id;
        $usermsg = PropertyMessage::where('agent_id',$id)->get();
        return view('agent.message.all_message',compact('usermsg'));

    }// End Method  
    public function AgentMessageDetails($id){

        $uid = Auth::user()->id;
        $usermsg = PropertyMessage::where('agent_id',$uid)->get();

        $msgdetails = PropertyMessage::findOrFail($id);
        return view('agent.message.message_details',compact('usermsg','msgdetails'));

    }// End Method  
    public function AgentScheduleRequest(){

        $id = Auth::user()->id;
        $usermsg = Schedule::where('agent_id',$id)->get();
        return view('agent.schedule.schedule_request',compact('usermsg'));

    }// End Method  
    public function AgentDetailsSchedule($id){

        $schedule = Schedule::findOrFail($id);
        return view('agent.schedule.schedule_details',compact('schedule'));

    } // End Method 
    public function AgentUpdateSchedule(Request $request){

        $sid = $request->id;
    
        $schedule = Schedule::findOrFail($sid);
        $schedule->update([
            'status' => '1',
        ]);
    
        // Send confirmation email
        Mail::to($schedule->user->email)->send(new ScheduleConfirmed($schedule));
    
        $notification = array(
            'message' => 'You have Confirm Schedule Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('agent.schedule.request')->with($notification);
    }
}
