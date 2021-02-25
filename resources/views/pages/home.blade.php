@extends('layouts.app')

@section('content')
    <div class="container">
        @isset ($daily_pronostics)
            <div class="row mt-4">
                <div class="col-md-12 d-md-flex justify-content-between">
                    <h1 class="font-italic font-weight-bold h2">Pronostics du jour</h1>
                    <h2 class="font-italic text-primary font-weight-bold">{{ Carbon\Carbon::parse($daily_pronostics->first()->date)->format('d/m/Y') }}</h2>
                </div>
            </div>

            @foreach ($daily_pronostics as $daily_pronostic)
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="border border-gray rounded-top px-3 py-4">
                            <div class="d-md-flex justify-content-between">
                                <div>
                                    <h3 class="font-weight-bold">
                                        <a href="{{ route('pronostic_show', $daily_pronostic->id) }}">
                                            @if ($daily_pronostic->sport == 'basket')
                                                <i class="fas fa-basketball-ball"></i>
                                            @elseif($daily_pronostic->sport == 'tennis')
                                                <i class="fas fa-table-tennis"></i>
                                            @else
                                                <i class="fas fa-futbol"></i>
                                            @endif
                                            {{ $daily_pronostic->sport }}
                                        </a>
                                    </h3>
                                </div>
                                <div class="d-flex">
                                    <img src="/upload/{{ $daily_pronostic->logo_1 }}" style="height: 50px;">
                                    @if (!empty($daily_pronostic->logo_2))
                                        <img src="/upload/{{ $daily_pronostic->logo_2 }}" style="height: 50px;">
                                    @endisset
                                </div>
                            </div>
                            <p class="montserrat">{{ $daily_pronostic->short_description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center">
                @if($subscription['football'] == true)
                    <a href="{{ route('pronostic_find_by_date', Carbon\Carbon::parse($daily_pronostics->first()->date)->format('Y-m-d') )}}" class="btn btn-primary btn-block text-white text-uppercase py-2">Accéder a tous les pronostics du jour</a>
                @elseif($daily_pronostic->free_access == 1)
                    <a href="{{ route('pronostic_find_by_date', Carbon\Carbon::parse($daily_pronostics->first()->date)->format('Y-m-d') )}}" class="btn btn-primary btn-block text-white text-uppercase py-2">Accéder a tous les pronostics du jour</a>
                @else
                    <a href="{{ route('subscription_index') }}" class="btn btn-primary btn-block text-white text-uppercase py-2">Disponible dans le Pack VIP</a>
                @endif
            </div>
        @endisset

        {{-- Derniers pronos validé --}}
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="border border-gray rounded-top px-3 py-4">
                    <h2 class="text-uppercase text-center h4 font-weight-bold font-italic mb-4">Derniers pronostics validé
                        <i class="fa fa-check vert-valide"></i>
                    </h2>
                    <hr>

                    @forelse($winning_pronostics as $winning_pronostic)
                        <div class="d-flex justify-content-between p-3">
                            <div>
                                <a href="{{ route('pronostic_show', $winning_pronostic->id) }}">
                                    @if ($winning_pronostic->sport == 'basket')
                                        <i class="fas fa-basketball-ball"></i>
                                    @elseif($winning_pronostic->sport == 'tennis')
                                        <i class="fas fa-table-tennis"></i>
                                    @else
                                        <i class="fas fa-futbol"></i>
                                    @endif
                                    {{ $winning_pronostic->sport }}
                                </a>
                                <br>
                                <p class="montserrat">{{ $winning_pronostic->short_description }}</p>
                            </div>
                            <div class="d-flex">
                                <img src="/upload/{{ $winning_pronostic->logo_1 }}" style="height: 50px;">
                                @if (!empty($winning_pronostic->logo_2))
                                    <img src="/upload/{{ $winning_pronostic->logo_2 }}" style="height: 50px;">
                                @endisset
                            </div>
                        </div>
                        <hr>
                    @empty
                        <p class="text-center">Aucun pronostic n'a été validé pour le moment.</p>
                    @endforelse
                </div>

                <div class="text-center">
                    <a href="{{ route('pronostic_index') }}" class="btn btn-block btn-primary text-white text-uppercase py-2">Voir l'historique des pronostics</a>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{ route('subscription_index') }}">
                    <img src="{{ asset('/img/pack_vip_mobile.png') }}" alt="Image pack vip" class="img-fluid d-block w-100">
                </a>
            </div>
        </div>

        {{-- Concours & réseaux --}}
        <div class="row mt-3">
            <div class="col-md-6">
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
                            <a href="{{ config('app.telegram_group_url') }}" rel="noreferrer" target="_blank" class="d-block px-1">
                                <img src="{{ asset('/img/logo_telegram.png') }}" alt="Lien vers le telegram de CashProno" class="img-fluid" style="max-height: 50px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-concours text-center py-5 font-weight-bold rounded p-0">
                    <a href="{{ route('giveaway_index') }}" class="text-white">
                        <h3 class="text-uppercase">Concours</h3>
                        <p>Enovoie-nous ton pronostic et tente de gagner des cadeaux !</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="border px-5 py-3 text-center h5 join-telegram">
                    <a href="{{ config('app.telegram_group_url') }}">
                        <i class="fab fa-telegram"></i>
                        Rejoignez nous sur Telegram et reçevez automatiquement une notification lorsqu'un pronostic est posté.
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
