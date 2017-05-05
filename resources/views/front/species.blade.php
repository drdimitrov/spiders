@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>Species list - {{ $genus->name }}</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Species</th>
            <th>Author</th>
          </tr>
        </thead>
        <tbody>
            @foreach($genus->species as $species)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td><a href="{{ route('species', $species->id) }}">{{ $species->name }}</a></td>
                    <td>{{ $species->author }}</td>                    
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection