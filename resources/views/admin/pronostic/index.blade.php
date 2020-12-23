@extends('layouts.admin')

@section('content')

    <h1 class="mt-5">Liste des pronostics</h1>
    <a href ="{{ route('admin.pronostic.create') }}" class="btn btn-primary mt-3">Créer un nouveau pronostic</a>

	<table class="table mt-5">
		<thead>
			<tr>
				<th>Id</th>
				<th>Sport</th>
				<th>Date</th>
				<th>Description</th>
				<th>Description rapide</th>
				<th>Logo 1</th>
				<th>Logo 2</th>
				<th>État</th>
				<th>Accessible à tous</th>
				<th>Actions</th>
			</tr>
        </thead>
		<tbody>
            @forelse ($pronostics as $pronostic)
                <tr>
                    <td>{{ $pronostic->id }}</td>
                    <td>{{ $pronostic->sport }}</td>
                    <td>{{ $pronostic->date->format('d/m/Y') }}</td>
                    <td>{{ $pronostic->description }}</td>
                    <td>{{ $pronostic->short_description }}</td>
                    <td><img src="{{ asset('/upload/' . $pronostic->logo_1) }}" style="height: 50px;"></td>
                    @if (!empty($pronostic->logo_2))                        
                        <td><img src="{{ asset('/upload/' . $pronostic->logo_2) }}" style="height: 50px;"></td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $pronostic->state }}</td>
                    <td>{{ $pronostic->free_access ? 'Oui' : 'Non'}}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.pronostic.edit', $pronostic->id )}}" class="btn btn-primary text-white mx-1"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.pronostic.destroy', $pronostic->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-primary mx-1" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Il n'y actuellement aucun pronostic de posté.</td>
                </tr>
            @endforelse
		</tbody>
    </table>
@endsection