<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = array();

        if (Auth::user()->subscribed('football')) {
            $data['subscription']['football'] = true;
        } else {
            $data['subscription']['football'] = false;
        }

        return view('subscription.index')->with($data);
    }

    /**
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function create_checkout_session(Request $request)
    {
        $this->validate($request, [
            'plan' => 'required'
        ]);

        if($request->plan !== 'price_1I5LRJDdfEiamf5bdNDkrgkg') // Football
        {
            return redirect()->route('homepage');
        }

        $data = [
            'intent' => auth()->user()->createSetupIntent()
        ];

        return view('subscription.payment')->with($data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws PaymentActionRequired
     * @throws PaymentFailure
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'token' => 'required',
            'plan' => 'required'
        ]);

        $user = Auth::user();

        if($request->plan == 'price_1I5LRJDdfEiamf5bdNDkrgkg')
        {
            $nom_abonnement = 'football';
        }

        if(isset($nom_abonnement) && !empty($nom_abonnement))
        {
            if($user->newSubscription($nom_abonnement, $request->plan)->create($request->token))
            {
                $request->session()->flash('success', 'Votre abonnement a été ajouté avec succès !');
            }
            else
            {
                $request->session()->flash('success', 'Une erreur s\'est produite, merci de réessayer');
            }
        }

        return redirect()->route('homepage');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function create_customer_portal_session(Request $request)
    {
        try {
            $session = Session::create([
                'customer' => Auth::user()->stripe_id,
                'return_url' => url('/'),
            ]);
            return redirect($session->url);
        } catch (ApiErrorException $e) {
            $request->session()->flash('danger', 'Une erreur s\'est produite.');
            return redirect()->route('homepage');
        }
    }
}
