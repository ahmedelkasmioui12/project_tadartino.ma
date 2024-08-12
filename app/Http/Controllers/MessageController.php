<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;

class MessageController extends Controller
{
    // Afficher le formulaire pour créer un message
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
