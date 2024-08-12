<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\State;
use Illuminate\Support\Facades\File; // Add this line

class StateController extends Controller
{
    public function AllState(){
        $state = State::latest()->get();
        return view('backend.state.all_state',compact('state'));
    }

    public function AddState(){
        return view('backend.state.add_state');
    }

    public function StoreState(Request $request){
        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        // Using GD Library to resize the image
        $img = imagecreatefromstring(file_get_contents($image));
        $width = 370;
        $height = 275;
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $width, $height, imagesx($img), imagesy($img));
        imagejpeg($tmp, public_path('upload/state/'.$name_gen));

        $save_url = 'upload/state/'.$name_gen;

        State::insert([
            'state_name' => $request->state_name,
            'state_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }

    public function EditState($id){
        $state = State::findOrFail($id);
        return view('backend.state.edit_state',compact('state'));
    }

    public function UpdateState(Request $request){
        $state_id = $request->id;

        if ($request->file('state_image')) {
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Using GD Library to resize the image
            $img = imagecreatefromstring(file_get_contents($image));
            $width = 370;
            $height = 275;
            $tmp = imagecreatetruecolor($width, $height);
            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $width, $height, imagesx($img), imagesy($img));
            imagejpeg($tmp, public_path('upload/state/'.$name_gen));

            $save_url = 'upload/state/'.$name_gen;

            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
                'state_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'State Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.state')->with($notification);
        } else {
            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
            ]);

            $notification = array(
                'message' => 'State Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.state')->with($notification);
        }
    }

    public function DeleteState($id) {
        $state = State::findOrFail($id);

        if (File::exists(public_path($state->state_image))) {
            File::delete(public_path($state->state_image));
        }

        $state->delete();

        return redirect()->route('all.state')->with([
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success',
        ]);
    }
    
}
