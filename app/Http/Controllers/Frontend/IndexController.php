<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\State; // This import is correct if State is a model
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyMessage;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\BlogPost;


class IndexController extends Controller
{
    public function PropertyDetails($id,$slug){
        $property = Property::findOrFail($id);
        $amenities = $property->amenities_id;
        $property_amen = explode(',',$amenities);
        $multiImage = MultiImage::where('property_id',$id)->get();
        $facility = Facility::where('property_id',$id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id',$type_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.property.property_details',compact('property','multiImage','property_amen','facility','relatedProperty'));
    }// End Method 
 
    
    public function PropertyMessage(Request $request){

        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {

        PropertyMessage::insert([

            'user_id' => Auth::user()->id,
            'agent_id' => $aid,
            'property_id' => $pid,
            'msg_name' => $request->msg_name,
            'msg_email' => $request->msg_email,
            'msg_phone' => $request->msg_phone,
            'message' => $request->message,
            'created_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Send Message Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



        }else{

            $notification = array(
            'message' => 'Plz Login Your Account First',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }

    }// End Method 
    public function AgentDetails($id){

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id',$id)->get();

        $featured = Property::where('featured','1')->limit(3)->get();
        $rentproperty = Property::where('property_status','rent')->get();
        $buyproperty = Property::where('property_status','buy')->get();


        return view('frontend.agent.agent_details',compact('agent','property','featured','rentproperty','buyproperty'));    }// End Method 
    public function AgentDetailsMessage(Request $request){

        $aid = $request->agent_id;

        if (Auth::check()) {

        PropertyMessage::insert([

            'user_id' => Auth::user()->id,
            'agent_id' => $aid, 
            'msg_name' => $request->msg_name,
            'msg_email' => $request->msg_email,
            'msg_phone' => $request->msg_phone,
            'message' => $request->message,
            'created_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Send Message Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



        }else{

            $notification = array(
            'message' => 'Plz Login Your Account First',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }

    }// End Method 

    public function RentProperty(){

        $property = Property::where('status','1')->where('property_status','rent')->get();

        return view('frontend.property.rent_property',compact('property'));

    }// End Method 
    public function BuyProperty(){

        $property = Property::where('status','1')->where('property_status','buy')->get();

        return view('frontend.property.buy_property',compact('property'));

    }// End Method 
    public function StateDetails($id)
    {
        $property = Property::where('status', '1')->where('state', $id)->get();
        $bstate = State::where('id', $id)->first();
    
        return view('frontend.property.state_property', compact('property', 'bstate'));
    }
    
    public function BuyPropertySeach(Request $request){

        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;

   $property = Property::where('property_name', 'like' , '%' .$item. '%')->where('property_status','buy')->with('type','pstate')
        ->whereHas('pstate', function($q) use ($sstate){
            $q->where('state_name','like' , '%' .$sstate. '%');
        })
        ->whereHas('type', function($q) use ($stype){
            $q->where('type_name','like' , '%' .$stype. '%');
         })
        ->get();

        return view('frontend.property.property_search',compact('property'));

    }// End Method 
    public function RentPropertySeach(Request $request){

        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;

   $property = Property::where('property_name', 'like' , '%' .$item. '%')->where('property_status','rent')->with('type','pstate')
        ->whereHas('pstate', function($q) use ($sstate){
            $q->where('state_name','like' , '%' .$sstate. '%');
        })
        ->whereHas('type', function($q) use ($stype){
            $q->where('type_name','like' , '%' .$stype. '%');
         })
        ->get();

        return view('frontend.property.property_search',compact('property'));

    }// End Method 
    
    public function AllPropertySeach(Request $request){

        $property_status = $request->property_status;
        $stype = $request->ptype_id; 
        $sstate = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

   $property = Property::where('status','1')->where('bedrooms',$bedrooms)->where('bathrooms', 'like' , '%' .$bathrooms. '%')->where('property_status',$property_status) 
        ->with('type','pstate')
        ->whereHas('pstate', function($q) use ($sstate){
            $q->where('state_name','like' , '%' .$sstate. '%');
        })
        ->whereHas('type', function($q) use ($stype){
            $q->where('type_name','like' , '%' .$stype. '%');
         })
        ->get();

        return view('frontend.property.property_search',compact('property'));

    }// End Method 
    public function StoreSchedule(Request $request){

        $aid = $request->agent_id;
        $pid = $request->property_id;

        if (Auth::check()) {

            Schedule::insert([

                'user_id' => Auth::user()->id,
                'property_id' => $pid,
                'agent_id' => $aid,
                'tour_date' => $request->tour_date,
                'tour_time' => $request->tour_time,
                'message' => $request->message,
                'created_at' => Carbon::now(), 
            ]);

             $notification = array(
            'message' => 'Send Request Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


        }else{

           $notification = array(
            'message' => 'Plz Login Your Account First',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

        }

    }// End Method 
    public function AllProperties()
{
    // Fetch all properties from the database
    $properties = Property::all();

    // Return the view with properties data
    return view('frontend.property.all_properties', compact('properties'));
}
public function AllPost()
{
    $post = BlogPost::latest()->get();
    return view('frontend.blog.all_blog', compact('post'));
}// End Method 


}
 