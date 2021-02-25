@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Pronostic #{{ $pronostic->id }}</h1>
            <div class="d-md-flex justify-content-between mt-4">
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
            {{ $pronostic->description }} 
            @if($pronostic->state == 'Gagnant')
                <i class="fa fa-2x fa-check vert-valide"></i>
            @elseif($pronostic->state == 'Perdant')
                <i class="fa fa-2x fa-times text-muted"></i>
            @endif
        </div>
    </div>
@endsection