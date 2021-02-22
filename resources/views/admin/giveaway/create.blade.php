@extends('layouts.admin')

@section('title', 'Gestion de concours')

@section('content')
<h1>Création d'un concours</h1>
<form action="{{ route('admin.giveaway.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="create-form form-group">
        <label for="date">Date de publication:</label>
        <input type="date" id="date" name="date" class="form-control">
    </div>

    <div class="create-form custom-file">
        <label class="custom-file-label" for="prize">Image du lot</label>
        <input type="file" class="custom-file-input" value="1" id="prize" name="prize">
    </div>

    <div class="create-form mt-3 text-center">
        <input type="text" name="home[]" /> vs <input type="text" name="opponent[]" /> <span class="add-match-btn btn btn-primary">+</span>
    </div>

    <button class="btn btn-primary">Créer le concours</button>
</form>
@endsection

@section('javascript')
<script src="{{ asset('js/contests-match.js') }}"></script>
@endsection