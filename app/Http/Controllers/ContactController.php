<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the contact form
     *
     * @return Application|Factory|View|void
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Treat and send contact mail
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function send(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'content' => 'required'
        ]);

        Mail::to(config('app.contact_mail'))->send(new ContactMail($request->get('email'), $request->get('content')));

        if( count(Mail::failures()) > 0 ) {
            $request->session()->flash('danger', 'Une erreur s\'est produite lors de l\'envoi de l\'email.');
         } else {
             $request->session()->flash('success', 'Votre demande de contact a été envoyé avec succès !');
         }

        return redirect()->route('homepage');
    }
}
