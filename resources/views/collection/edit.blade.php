@extends('layouts.app')

@section('content')
  <div class="container dark-mode">
    <div class="p-4">
      <h2 class="text-black">Edit Album</h2>
      <form method="POST" action="{{ route('collection.update', $collected->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-6">

            Currently empty

            <button class="btn btn-success" type="submit">Update Album</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
