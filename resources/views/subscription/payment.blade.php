@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payer mon abonnement</div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/img/secure-payment.jpg') }}" style="height: 100px;">
                    </div>
                    <form id="payment-form" action="{{ route('subscription_payments_store') }}" method="post" class="mt-4">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                        <div class="form-group">
                            <label for="">Nom complet</label>
                            <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Nom complet sur la carte">
                        </div>
                        <div class="form-group">
                            <label for="">Informations de votre carte bancaires</label>
                            <div id="card-element"></div>
                        </div>

                        <div class="alert alert-warning mt-4">
                            Il se peut que vous voyez affiché le montant de 0€ lors de votre paiement en utilisant 3D Secure. Ce montant est faux, vous serez bien facturé le prix de l'abonnement. Il sagit d'un problème venant de notre fournisseur. Veuillez-nous excusez pour la gène occasionnée.
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="card-button" data-secret="{{ $intent->client_secret }}">Payer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card', {
        hidePostalCode: true
    })

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if(error) {
            cardBtn.disable = false
        } else {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection
