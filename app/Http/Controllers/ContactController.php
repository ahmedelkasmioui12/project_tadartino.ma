<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $data = $request->all();

        Mail::to('tadartinotadartino@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
