<a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">Bekijk</a>

<a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Wijzig</a>

<form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="btn btn-danger"
            onclick="return confirm('Are you sure?')">
        Delete
    </button>
</form>
