<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\State;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('userData'));
    }

    public function userProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        ];

        return redirect('/login')->with($notification);
    }

    public function userChangePassword()
    {
        return view('frontend.dashboard.change_password');
    }

    public function userPasswordUpdate(Request $request)
    {
        // Validate request
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Check if the old password matches
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $notification = [
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }

        // Update to new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    public function userScheduleRequest()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        $srequest = Schedule::where('user_id', $id)->get();
        return view('frontend.message.schedule_request', compact('userData', 'srequest'));
    }

    public function createUserProperties()
    {
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $pstate = State::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('frontend.dashboard.add_property', compact('propertytype', 'amenities', 'activeAgent', 'pstate'));
    }

    public function storeUserProperties(Request $request)
    {
        // Validate request data
        $request->validate([
            'ptype_id' => 'required|integer',
            'amenities_id' => 'array',
            'property_name' => 'required|string|max:255',
            'property_status' => 'string|required',
            'property_thambnail' => 'image|mimes:jpg,jpeg,png|max:2048',
            'multi_img.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Generate a unique property code
        $propertyCode = 'Appartement' . strtoupper(Str::random(5));
        while (Property::where('property_code', $propertyCode)->exists()) {
            $propertyCode = 'Appartement' . strtoupper(Str::random(5));
        }
    
        // Handle thumbnail image upload
        $thumbnailPath = null;
        if ($request->hasFile('property_thambnail')) {
            $thumbnail = $request->file('property_thambnail');
            $thumbnailName = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = 'upload/property/thambnail/' . $thumbnailName;
            $thumbnail->move(public_path('upload/property/thambnail'), $thumbnailName);
        }
    
        // Create the property
        $property = Property::create([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => is_array($request->amenities_id) ? implode(',', $request->amenities_id) : $request->amenities_id ?? '',
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $propertyCode,
            'property_status' => $request->property_status,
            'property_thambnail' => $thumbnailPath,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'property_video' => $request->property_video, 
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'garage_size' => $request->garage_size,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'agent_id' => $request->agent_id,
            'featured' => $request->featured,
            'hot' => $request->hot,
        ]);
    
        // Process multiple images
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
    
        // Process facilities if provided
        if ($request->facility_name) {
            foreach ($request->facility_name as $i => $facility_name) {
                Facility::create([
                    'property_id' => $property->id,
                    'facility_name' => $facility_name,
                    'distance' => $request->distance[$i] ?? null,
                ]);
            }
        
        }
    
        return redirect()->route('user.properties.create')->with('success', 'Property added successfully!');
    }
    
}