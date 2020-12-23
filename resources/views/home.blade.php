@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- {{-- if daily_pronostic is not empty --}}
            <div class="row">
                <div class="col-md-12 d-md-flex justify-content-between">
                    <h1 class="font-italic font-weight-bold h2">Pronostics du jour</h1>
                    <h2 class="font-italic text-primary font-weight-bold">date</h2>
                </div>
            </div>
            {{-- for pronostic in daily_pronostic --}}
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="border border-gray rounded-top px-3 py-4">
                            <div class="d-md-flex justify-content-between">
                                <div>
                                    <h3 class="font-weight-bold">
                                        {{-- if pronostic.sport == "BasketBall" --}}
                                            <i class="fas fa-basketball-ball"></i>
                                        {{-- elseif pronostic.sport == "Tennis" --}}
                                            <i class="fas fa-table-tennis"></i>
                                        {{-- else --}}
                                            <i class="fas fa-futbol"></i>
                                        {{-- endif --}}
                                        Sport
                                    </h3>
                                </div>
                                <div class="d-flex">
                                    img ligue1
                                    {{-- if pronostic.logo2 is defined and pronostic.logo2 is not empty --}}
                                        img ligue1
                                    {{-- endif --}}
                                </div>
                            </div>
                            descriptionRapide
                        </div>
                    </div>
                </div>
            {{-- endfor --}}
            <div class="text-center">
                {{-- if app.user is defined and is_granted('ROLE_FOOTBALL') --}}
                    <a href="{{ url('pronostic_show') }}" class="btn btn-primary btn-block text-white text-uppercase py-2">Accéder a tous les pronostics du jour</a>
                {{-- else --}}
                    <a href="{{ url('subscription_index') }}" class="btn btn-primary btn-block text-white text-uppercase py-2">Disponible dans le Pack VIP</a>
                {{-- endif --}}
            </div>
        {{-- endif --}}

        {{-- Derniers pronos validé --}}
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="border border-gray rounded-top px-3 py-4">
                    <h2 class="text-uppercase text-center h4 font-weight-bold font-italic mb-4">Derniers pronostics validé
                        <i class="fa fa-check vert-valide"></i>
                    </h2>
                    <hr>
                    {{-- if pronostics_valides is defined and pronostics_valides is not empty --}}
                        {{-- for pronostic in pronostics_valides --}}
                            <div class="d-flex justify-content-between p-3">
                                <div>
                                    sport
                                    <br>
                                    descriptionRapide
                                </div>
                                <div>
                                    logo ligue1
                                    {{-- if pronostic.logo2 is defined and pronostic.logo2 is not empty --}}
                                    logo ligue1
                                    {{-- endif --}}
                                </div>
                            </div>
                            <hr>
                        {{-- endfor --}}
                    {{-- else --}}
                        <p class="text-center">Aucun pronostic n'a été validé pour le moment.</p>
                    {{-- endif --}}
                </div>
                <div class="text-center">
                    <a href="{{ url('pronostic_index') }}" class="btn btn-block btn-primary text-white text-uppercase py-2">Voir l'historique des pronostics</a>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <a href="{{ url('subscription_index') }}">
                    <img src="{{ asset('/img/pack_vip.png') }}" alt="Image pack vip" class="img-fluid d-none d-md-block w-100">
                </a>
                <a href="{{ url('subscription_index') }}">
                    <img src="{{ asset('/img/pack_vip_mobile.png') }}" alt="Image pack vip mobile" class="img-fluid d-block d-md-none w-100">
                </a>
            </div>
        </div>

        {{-- Concours & réseaux --}}
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="d-flex align-items-center justify-content-center border border-gray rounded text-center py-3 h-100">
                    <div>
                        <p class="h4 font-weight-bold">Rejoignez-nous sur les réseaux !</p>
                        <br>
                        <div class="d-flex justify-content-center">
                            <a href="http://instagram.com/cashpronofra" rel="noreferrer" target="_blank" class="d-block px-1">
                                <img src="{{ asset('/img/logo_instagram.png') }}" alt="Lien vers le instagram de CashProno" class="img-fluid" style="max-height: 50px;">
                            </a>
                            <a href="https://www.snapchat.com/add/cashpronofra" rel="noreferrer" target="_blank" class="d-block px-1">
                                <img src="{{ asset('/img/snapchat_cashprono.png') }}" alt="Lien vers le snapchat de CashProno" class="img-fluid" style="max-height: 50px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5 bg-concours text-center py-5 text-white font-weight-bold rounded h-100">
                <h3 class="text-uppercase">Concours</h3>
                <p>Enovoie-nous ton pronostic et tente de gagner des cadeaux !</p>
            </div>
        </div>
    </div>
@endsection
