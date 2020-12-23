<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact
     *
     * @return void
     */
    public function index() 
    {
        return view('contact');
    }

    /**
     * Traitement et envoie de l'email de contact
     *
     * @param Request $request
     * @return void
     */
    public function send(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email',
            'content' => 'required'
        ]);

        Mail::to(env('CONTACT_MAIL'))->send(new ContactMail($request->get('email'), $request->get('content')));

        if( count(Mail::failures()) > 0 ) {
            $request->session()->flash('danger', 'Une erreur s\'est produite lors de l\'envoi de l\'email.');
         } else {
             $request->session()->flash('success', 'Votre demande de contact a été envoyé avec succès !');
         }
         
        return redirect()->route('homepage');
    }
}
