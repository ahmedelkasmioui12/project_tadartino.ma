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
use App\Models\Wishlist; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $property_id)
    {
        Log::info('AddToWishList called', ['property_id' => $property_id]);

        try {
            if (Auth::check()) {
                Log::info('User is authenticated', ['user_id' => Auth::id()]);
                
                $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
                
                Log::info('Wishlist check', ['exists' => $exists]);

                if (!$exists) {
                    Wishlist::create([
                        'user_id' => Auth::id(),
                        'property_id' => $property_id,
                        'created_at' => Carbon::now()
                    ]);

                    Log::info('Property added to wishlist', ['property_id' => $property_id]);

                    return response()->json(['success' => 'Successfully Added On Your Wishlist']);
                } else {
                    Log::info('Property already in wishlist', ['property_id' => $property_id]);

                    return response()->json(['error' => 'This Property Has Already in your WishList']);
                }
            } else {
                Log::info('User not authenticated');

                return response()->json(['error' => 'At First Login Your Account']);
            }
        } catch (\Exception $e) {
            Log::error('Error adding to wishlist', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }





    public function UserWishlist(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.wishlist',compact('userData'));
    }// End Method 
    
    public function GetWishlistProperty(){
        $wishlist = Wishlist::with('property')->where('user_id',Auth::id())->latest()->get();
        $wishQty = wishlist::count();
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }// End Method 


    public function WishlistRemove($id){

      Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
      return response()->json(['success' => 'Successfully Property Remove']);

    }// End Method 




}
 