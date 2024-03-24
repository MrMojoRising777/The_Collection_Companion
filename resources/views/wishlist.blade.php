@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Verlanglijst</h1>

    <blockquote>
      <i>Bekijk en doorzoek JOUW verlanglijst. Bekijk welke strips je graag zou willen (bekijk ook welke je kan kopen en waar).</i>
    </blockquote>

    @if ($wishlist->isEmpty())
      <p><i>Er zijn geen albums gevonden in je verlanglijst</i></p>
    @else
      <div class="row">
        <div class="col-md-4 mb-3">
          {{-- @if (Route::currentRouteName() !== 'collection.index')
            <a href="{{ route('collection.index') }}" class="btn btn-success">
              Collectie
            </a>
          @endif --}}
        </div>
      </div>

      {{ $wishlist->links() }}

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Serie</th>
              <th>Nummer</th>
              <th>Kaft</th>
              <th>Uitgebracht</th>
              <th>Acties</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($wishlist as $item)
              <tr>
                <td class="d-flex">
                  <form method="POST" action="{{ route('wishlist.remove', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Dit verwijdert je album uit je verlanglijst. Ben je zeker dat je dit wil?')">
                      Verwijder
                    </button>
                  </form>
                </td>
                <td>{{ $item->album->name }}</td>
                <td>{{ $item->album->serie->name }}</td>
                <td>{{ $item->album->volume }}</td>
                <td>{{ $item->album->cover }}</td>
                <td>{{ $item->album->first_print }}</td>
                <td>
                  <a href="{{ route('collection.albums.show', $item->album_id) }}" class="btn btn-info">Bekijk</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
