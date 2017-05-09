@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>Species by locality</h1>
      </div>

      <form action="{{ route('stat.locality.single') }}" method="POST">
        <div class="form-group">
          <label for="sel1">Select locality:</label>
          <select class="form-control" name="locality">
            @foreach($localities as $locality)
              <option value="{{ $locality->id }}">{{ $locality->name }}</option>
            @endforeach            
          </select>
        </div>
        <div class="form-group">
          <button class="btn btn-default">Show species</button>
        </div>
        {{ csrf_field() }}
      </form>
</div>
@endsection