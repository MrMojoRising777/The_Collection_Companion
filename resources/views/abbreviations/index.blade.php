@extends('layouts.app')

@section('content')
  @foreach ($abbreviations as $abbreviation)
      <ul>
        <li>
          {{ $abbreviation->period }}
        </li>
      </ul>
  @endforeach
@endsection