<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // Make sure this is included for resizing
use App\Models\PropertyMessage;
use App\Models\State;
class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.all_property', compact('property'));
    }

    public function AddProperty()
    {
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $pstate = State::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.add_property',compact('propertytype','amenities','activeAgent','pstate'));    }

    public function StoreProperty(Request $request)
    {
        $request->validate([
            'property_name' => 'required|string|max:255',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg',
            'amenities_id' => 'array',
        ]);
    
        $amenities = implode(",", $request->amenities_id);
        $propertyCode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'Appartement']);
    
        // Process main image
        $thumbnail = $request->file('property_thambnail');
        $thumbnailName = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnailPath = 'upload/property/thambnail/' . $thumbnailName;
        $thumbnail->move(public_path('upload/property/thambnail'), $thumbnailName);
    
        $property = Property::create([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $propertyCode,
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
            'featured' => $request->featured ? 1 : 0,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thambnail' => $thumbnailPath,
        ]);
    
        // Handle multiple images
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $imgName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $imgPath = 'upload/property/multi-image/' . $imgName;
                $img->move(public_path('upload/property/multi-image'), $imgName);
    
                MultiImage::create([
                    'property_id' => $property->id,
                    'photo_name' => $imgPath,
                ]);
            }
        }
    
        // Add facilities
        if ($request->facility_name) {
            foreach ($request->facility_name as $i => $facility_name) {
                Facility::create([
                    'property_id' => $property->id,
                    'facility_name' => $facility_name,
                    'distance' => $request->distance[$i] ?? null,
                ]);
            }
        }
    
        return redirect()->route('all.property')->with('message', 'Property Inserted Successfully')->with('alert-type', 'success');
    }
    

    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);
        $propertyTypes = PropertyType::latest()->get();
        $amenitiesList = Amenities::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        
        $property_amenities = explode(',', $property->amenities_id);
        $multiImage = MultiImage::where('property_id', $id)->get();
        $facilities = Facility::where('property_id', $id)->get();
        $pstate = State::latest()->get();
    
        return view('backend.property.edit_property', compact(
            'property', 
            'propertyTypes', 
            'amenitiesList', 
            'activeAgents', 
            'property_amenities', 
            'multiImage', 
            'facilities',
            'pstate'
        ));
    }
    
    public function UpdateProperty(Request $request)
    {
        $request->validate([
            'property_name' => 'required|string|max:255',
            'property_thambnail' => 'nullable|image|mimes:jpeg,png,jpg',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg',
            'amenities_id' => 'array|nullable',
        ]);
    
        // Check if 'amenities_id' is an array before calling implode
        $amenities = is_array($request->amenities_id) ? implode(",", $request->amenities_id) : '';
    
        $property = Property::findOrFail($request->id);
    
        $property->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
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
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'agent_id' => $request->agent_id,
            'featured' => $request->featured,
            'hot' => $request->hot,
        ]);
    
        return redirect()->route('all.property')->with('message', 'Property Thumbnail Updated Successfully')->with('alert-type', 'success');
    }
    
    public function UpdatePropertyThumbnail(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:properties,id',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $property = Property::findOrFail($request->id);
        $oldImage = public_path($property->property_thambnail);

        if ($request->hasFile('property_thambnail')) {
            $thumbnail = $request->file('property_thambnail');
            $thumbnailName = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = 'upload/property/thambnail/' . $thumbnailName;

            // Resize thumbnail image
            $this->resizeImage($thumbnail, public_path($thumbnailPath), 370, 250);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $property->update([
                'property_thambnail' => $thumbnailPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('all.property')->with('message', 'Property Thumbnail Updated Successfully')->with('alert-type', 'success');
    }

    public function UpdatePropertyFacilities(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:properties,id',
            'facility_name' => 'array',
            'distance' => 'array',
        ]);

        $propertyId = $request->id;

        // Remove existing facilities
        Facility::where('property_id', $propertyId)->delete();

        // Add new facilities
        if ($request->facility_name) {
            foreach ($request->facility_name as $i => $facility_name) {
                Facility::create([
                    'property_id' => $propertyId,
                    'facility_name' => $facility_name,
                    'distance' => $request->distance[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('all.property')->with('message', 'Property Facilities Updated Successfully')->with('alert-type', 'success');
    }
    

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        $oldImage = public_path($property->property_thambnail);
        
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        // Delete associated images
        MultiImage::where('property_id', $id)->each(function($image) {
            $imagePath = public_path($image->photo_name);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        });

        // Delete associated facilities
        Facility::where('property_id', $id)->delete();

        $property->delete();

        return redirect()->route('all.property')->with('message', 'Property Deleted Successfully')->with('alert-type', 'success');
    }

    private function resizeImage($image, $path, $width, $height)
    {
        $img = Image::make($image);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
    }
    public function UpdatePropertyThambnail(Request $request)
{
    // Validate the request
    $request->validate([
        'id' => 'required|integer|exists:properties,id',
        'property_thambnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
    ]);

    $property = Property::findOrFail($request->id);
    $oldImage = public_path($property->property_thambnail);

    if ($request->hasFile('property_thambnail')) {
        // Process the uploaded thumbnail image
        $thumbnail = $request->file('property_thambnail');
        $thumbnailName = time() . '-' . $thumbnail->getClientOriginalName();
        $thumbnailPath = 'images/thumbnails/' . $thumbnailName;

        $thumbnail->move(public_path('images/thumbnails'), $thumbnailName);

        // Delete old image if it exists
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        // Update the property with the new thumbnail path
        $property->update([
            'property_thambnail' => $thumbnailPath,
        ]);
    }

    return redirect()->back()->with('success', 'Thumbnail updated successfully.');
}
public function StoreNewMultiimage(Request $request){ 
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
public function PropertyMultiImageDelete($id){
    $oldImg = MultiImage::findOrFail($id);
    unlink(public_path($oldImg->photo_name));
    MultiImage::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Property Multi Image Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}


public function DetailsProperty($id){
    $facilities = Facility::where('property_id',$id)->get();
    $property = Property::findOrFail($id);
    $type = $property->amenities_id;
    $property_ami = explode(',', $type);
    $multiImage = MultiImage::where('property_id',$id)->get();
    $propertytype = PropertyType::latest()->get();
    $amenities = Amenities::latest()->get();
    $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
    return view('backend.property.details_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'));
}// End Method 

public function InactiveProperty(Request $request){

    $pid = $request->id;
    Property::findOrFail($pid)->update([

        'status' => 0,

    ]);

  $notification = array(
        'message' => 'Property Inactive Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.property')->with($notification); 


}// End Method 


  public function ActiveProperty(Request $request){

    $pid = $request->id;
    Property::findOrFail($pid)->update([

        'status' => 1,

    ]);

  $notification = array(
        'message' => 'Property Active Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.property')->with($notification); 


}// End Method 


public function AdminPropertyMessage(){

    $usermsg = PropertyMessage::latest()->get();
    return view('backend.message.all_message',compact('usermsg'));

}// End Method  


public function UpdatePropertyMultiimage(Request $request){
    // Validate the request to ensure 'multi_img' is an array of files
    $request->validate([
        'multi_img' => 'required|array',
        'multi_img.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Get the multi_img from the request
    $imgs = $request->file('multi_img');

    // Check if the multi_img is not empty and is an array
    if (is_array($imgs)) {
        foreach ($imgs as $id => $img) {
            // Ensure each item in the array is a valid file before proceeding
            if ($img && $img->isValid()) {
                $imgDel = MultiImage::findOrFail($id);

                // Delete the old image
                if (file_exists(public_path($imgDel->photo_name))) {
                    unlink(public_path($imgDel->photo_name));
                }

                // Generate a new unique file name and move the file
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('upload/property/multi-image'), $make_name);
                $uploadPath = 'upload/property/multi-image/' . $make_name;

                // Update the MultiImage record with the new file path
                MultiImage::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                return redirect()->back()->with('error', 'One or more files are invalid.');
            }
        }

        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    } else {
        return redirect()->back()->with('error', 'No valid files were provided.');
    }
}

public function showForm()
{
    return view('backend.subscribe.subscribe');
}

// Envoyer le message aux abonnés
public function sendMessage(Request $request)
{
    // Validation des données
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $subject = $request->input('subject');
    $message = $request->input('message');

    // Récupérer tous les abonnés
    $subscribers = Subscription::all();

    // Envoyer l'email à chaque abonné
    foreach ($subscribers as $subscriber) {
        Mail::raw($message, function ($msg) use ($subscriber, $subject) {
            $msg->to($subscriber->email)
                ->subject($subject);
        });
    }

    // Notification de succès
    return redirect()->back()->with('success', 'Message sent to all subscribers!');
}


}
