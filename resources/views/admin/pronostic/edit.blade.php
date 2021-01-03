@extends('layouts.admin')

@section('content')

    <h1 class="mt-5">Éditer le pronostic</h1>

    <form action="{{ route('admin.pronostic.update', $pronostic->id) }}" class="mt-5" enctype="multipart/form-data" method="post">
        @csrf
        @method('put')
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
                    <input type="date" name="date" id="date" class="form-control" value="{{ $pronostic->date->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sport">Sport concerné</label>
                    <select name="sport" id="sport" class="form-control" required>
                        <option value="football"  {{ $pronostic->sport == 'football' ? 'selected' : '' }}>Football</option>
                        <option value="tennis" {{ $pronostic->sport == 'tennis' ? 'selected' : '' }}>Tennis</option>
                        <option value="basket" {{ $pronostic->sport == 'basket' ? 'selected' : '' }}>Basket-ball</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="description" name="description" id="description" class="form-control" required>{{ $pronostic->description }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="short_description">Description rapide (visible par tous)</label>
                    <textarea type="short_description" name="short_description" id="short_description" class="form-control" required>{{ $pronostic->short_description }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="state">État du paris</label>
                    <select name="state" id="state" class="form-control" required>
                        <option value="En attente"  {{ $pronostic->state == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Gagnant" {{ $pronostic->state == 'Gagnant' ? 'selected' : '' }}>Gagnant</option>
                        <option value="Perdant" {{ $pronostic->state == 'Perdant' ? 'selected' : '' }}>Perdant</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="free_access" name="free_access" {{ $pronostic->free_access ? 'checked' : '' }}>
                    <label class="form-check-label" for="free_access" >
                      Accessible à tous
                    </label>
                </div>
            </div>
        </div>
        <button class="mt-3 btn btn-primary">Modifier le pronostic</button>
    </form>
@endsection