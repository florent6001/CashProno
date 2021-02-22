@extends('layouts.app')

@section('title', 'Concours')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Concours</h1>
            <hr>
            <p><strong>Comment participer ?</strong></p>
            <p>Pour participer à notre concours hebdomadaire, veuillez sélectionner vos pronostics ci-dessous et valider !</p>
            <br>
            <p><strong>A gagner le {{ \Carbon\Carbon::parse($contest->date)->format('d/m/Y') }}</strong></p>
            <p><img src="{{ asset('/upload/' . $contest->image_src) }}" class="prize" alt="Lot" /></p>

            <div id="contest">
                <p><strong>Liste des matchs (Cochez l'équipe que vous pensez gagnante) :</strong></p>

                <table class="matchs d-flex justify-content-center">
                    @foreach($matchs as $match)
                        <tr>
                            <td class="buttons" data-match="{{ $match->id }}">
                                <button class="btn btn-primary" data-result="1">{{ $match->home }}</button> 
                                <button class="btn btn-primary" data-result="2">NUL</button>
                                <button class="btn btn-primary" data-result="3">{{ $match->opponent }}</button>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <a class="btn btn-primary mt-5 prize-btn">Placer mon pronostic</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>

        $(function() {
            $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
            });
        });

        $('.buttons button').click(function() {
            $(this).siblings().removeClass('active');
            $(this).toggleClass('active');
        });

        $('.prize-btn').click(function() {
            if ($('table tr').length == $('table tr .active').length) {
                var parameters = [];

                $('table tr .active').each(function() {
                    var element = {};
                    element.id = $(this).parent().data('match');
                    element.result = $(this).data('result');
                    parameters.push(element);
                    console.log(element);
                });

                $.post(
                    '/concours/ajax',
                    {
                        parameters: parameters
                    },
                    function(data) {
                        if (data == 'ok') {
                            $('#contest').html('<p class="alert alert-success">Merci pour votre participation, votre participation a bien été comptabilisé !</p>');
                        } else {
                            $('#contest .alert').remove();
                            $('#contest').append('<p class="alert alert-danger mt-5"> Une erreur s\'est produite. </p>');
                        }
                    },
                    'text'
                );
            } else {
                $('#contest .alert').remove();
                $('#contest').append('<p class="alert alert-danger mt-5">Vous devez remplir tous les matchs pour participer !</p>');
            }
        });
    </script>    
@endsection