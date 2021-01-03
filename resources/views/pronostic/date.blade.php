@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Pronostic du {{ Carbon\Carbon::parse($date)->format('d/m/Y') }} </h1>
                @foreach ($pronostics as $pronostic)
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="border border-gray rounded-top px-3 py-4">
                                <div class="d-md-flex justify-content-between">
                                    <div>
                                        <a class="font-weight-bold h3" href="{{ route('pronostic_show', $pronostic->id) }}">
                                            @if ($pronostic->sport == 'basket')
                                                <i class="fas fa-basketball-ball"></i>
                                            @elseif($pronostic->sport == 'tennis')
                                                <i class="fas fa-table-tennis"></i>
                                            @else
                                                <i class="fas fa-futbol"></i>
                                            @endif
                                            {{ $pronostic->sport }}
                                        </a>
                                    </div>
                                    <div class="d-flex">
                                        <img src="/upload/{{ $pronostic->logo_1 }}" style="height: 50px;">
                                        @if (!empty($pronostic->logo_2))
                                            <img src="/upload/{{ $pronostic->logo_2 }}" style="height: 50px;">
                                        @endisset
                                    </div>
                                </div>
                                {{ $pronostic->short_description }}
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection