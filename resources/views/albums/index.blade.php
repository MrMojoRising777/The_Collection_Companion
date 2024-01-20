@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Albums</h2>

        <a href="{{ route('albums.create') }}" class="btn btn-primary">Create</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Comic</th>
                        <th>Serie</th>
                        <th>Volume</th>
                        <th>Obtained</th>
                        <th>Cover</th>
                        <th>Print Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                        <tr>
                            <td>{{ $album->id }}</td>
                            <td>{{ $album->name }}</td>
                            <td>{{ $album->comic->name }}</td>
                            <td>{{ $album->serie->name }}</td>
                            <td>{{ $album->volume }}</td>
                            <td>{{ $album->obtained ? 'Yes' : 'No' }}</td>
                            <td>{{ $album->cover }}</td>
                            <td>{{ $album->print_year }}</td>
                            <td>
                                <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
