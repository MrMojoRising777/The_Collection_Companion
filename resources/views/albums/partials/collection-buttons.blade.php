<form method="POST" action="{{ route('albums.toggleCollected', $album) }}">
    @csrf
    @if ($album->isInCollection())
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Verwijder</button>
    @else
        <button type="submit" class="btn btn-success">Verzamel</button>
    @endif
</form>

<form method="POST" action="{{ route('wishlist.toggleWishlist', $album) }}">
    @csrf
    <button type="submit" class="btn">
        <i class="bi bi-heart"></i>
    </button>
</form>
