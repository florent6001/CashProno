@extends('layouts.admin')

@section('title', 'Gestion de concours')

@section('content')

    <h2>Concours en cours</h2>

    Fin le {{ \Carbon\Carbon::parse($contest->date)->format('d/m/Y') }}

    <p><b>Lot:</b></p>

    <p><img src="{{ asset('/upload/' . $contest->image_src) }}" class="prize" alt="Lot" /></p>

    <form action="{{ route('admin.giveaway.update', $contest->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="create-form">
            <label for="viponlyform">Lot:</label>
            <input type="file" value="1" id="prize" name="prize">
            <button>Modifier</button>
        </div>
    </form>

    <p class="mt-3">Liste des matchs :</p>
    <table class="matchs">
        @foreach($matchs as $match)
            <tr>
                <td>{{ $match->home }}</td>
                <td> vs </td>
                <td>{{ $match->opponent }}</td>
            </tr>
        @endforeach
    </table>

    <form action="{{ route('admin.giveaway.destroy', $contest->id) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-primary mt-4">Annuler le concours</a>
    </form>

@endsection

@section('javascript')
<script src="{{ asset('js/contests-match.js') }}"></script>
@endsection