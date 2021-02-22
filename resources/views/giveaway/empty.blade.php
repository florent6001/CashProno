@extends('layouts.app')

@section('title', 'Concours')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Concours</h1>
            <hr>
            <p>Aucun concours n'est en cours pour le moment !</p>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/contest.js') }}"></script>
@endsection