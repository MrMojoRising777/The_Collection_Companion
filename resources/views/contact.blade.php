@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Contacteer ons</div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}">
              @csrf

              <div class="form-group">
                <label for="subject">Onderwerp</label>
                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                  name="subject" value="{{ old('subject') }}" required autofocus>
                @error('subject')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="message">Bericht</label>
                <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="6"
                  required>{{ old('message') }}</textarea>
                @error('message')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Verzend</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
