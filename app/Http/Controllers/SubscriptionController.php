<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showForm()
    {
        return view('frontend.home.subscribe');
    }

    // Traiter la soumission du formulaire
    public function subscribe(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Enregistrer l'email dans la base de données
        // Assurez-vous que vous avez une table pour stocker les abonnements
        \DB::table('subscriptions')->insert([
            'email' => $email,
            'created_at' => now(),
        ]);

        // Envoyer un email de confirmation
        Mail::raw('Thank you for subscribing to our newsletter!', function ($message) use ($email) {
            $message->to($email)
                    ->subject('Subscription Confirmation');
        });

        // Notification de succès
        return redirect()->back()->with('success', 'You have successfully subscribed!');
    }
}
