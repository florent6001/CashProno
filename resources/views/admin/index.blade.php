@extends('layouts.admin')

@section('content')
    <h1>Espace d'administration</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Nombre de membres inscrits
                </div>
                <div class="card-body">
                    {{ $members_count }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Nombre de membres VIP
                </div>
                <div class="card-body">
                    {{ $vip_count }}
                </div>
            </div>
        </div>
    </div>
@endsection