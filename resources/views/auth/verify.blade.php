@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vérifier votre adresse email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un lien de vérification a été envoyé à votre adresse email.
                        </div>
                    @endif

                    Avant de continuer, merci de vérifier votre messagerie pour obtenir le lien de vérification.
                    Si vous n'avez pas reçu l'email, 
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Cliquez ici pour en reçevoir un autre.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
