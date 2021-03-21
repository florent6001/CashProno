@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5 font-weight-bold">Liste des abonnements</h1>
        <div class="col-lg-4 mb-5 mb-lg-0 offset-lg-4 mt-4">
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="h6 text-uppercase font-weight-bold mb-4">Paris Sportif</h2>
                <h3 class="h3 font-weight-bold">14,99 €<span class="text-small font-weight-normal ml-2">/ mois</span></h3>

                <ul class="list-unstyled my-5 text-small text-left">
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> Pronostics safe quotidien</li>
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> Pronostics fun
                        </li>
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> Cadeaux à gagner</li>
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> Bankroll VIP</li>
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> Remboursé sous 55% de réussite sur le mois<sup>(1)</sup></li>
                </ul>

                @if($subscription['football'] == true)
                    <form method="POST" action="{{ route('subscription_create_customer_portal_session') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block p-2 shadow rounded-pill">Gérer mon abonnement</button>
                    </form>
                @else
                    <a href="{{ route('subscription_payments', ['plan' => config('app.football_price_id')]) }}" class="btn btn-primary btn-block p-2 shadow rounded-pill">
                        S'abonner
                    </a>
                @endif
            </div>
        </div>

        <br>
        <p class="mt-5">
            <sup>(1)</sup>Remboursé seulement sous 55% de réussite des pronostics posté sur notre site, non celle parié exclusivement par le joueur. Ne prend pas en compte les pronostics funs.
        </p>
    </div>
@endsection

