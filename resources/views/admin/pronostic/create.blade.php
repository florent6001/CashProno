@extends('layouts.admin')

@section('content')

    <h1 class="mt-5">Créer un pronostic</h1>

    <form action="{{ route('admin.pronostic.store') }}" class="mt-5" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date">Date du parie</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sport">Sport concerné</label>
                    <select name="sport" id="sport" class="form-control" required>
                        <option value="Football"  {{ old('sport') == 'Football' ? 'selected' : '' }}>Football</option>
                        <option value="Tennis" {{ old('sport') == 'Tennis' ? 'selected' : '' }}>Tennis</option>
                        <option value="Basket" {{ old('sport') == 'Basket' ? 'selected' : '' }}>Basket-ball</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="description" name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="short_description">Description rapide (visible par tous)</label>
                    <textarea type="short_description" name="short_description" id="short_description" class="form-control" required>{{ old('short_description') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-file">
                    <label for="logo_1" class="custom-file-label">Logo de ligue 1</label>
                    <input type="file" name="logo_1" id="logo_1" class="custom-file-input" value="{{ old('logo_1') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-file">
                    <label for="logo_2" class="custom-file-label">Logo de ligue 2 (optionnel)</label>
                    <input type="file" name="logo_2" id="logo_2" class="custom-file-input" {{ old('logo_2') }}>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="free_access" name="free_access" {{ old('free_access') ? 'checked' : '' }}>
                    <label class="form-check-label" for="free_access" >
                      Accessible à tous
                    </label>
                </div>
            </div>
        </div>
        <button class="mt-3 btn btn-primary">Créer le pronostic</button>
    </form>
@endsection