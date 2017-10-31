@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1><i style="font-weight: bold;">{{ $genus->name }}</i> - list of species</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Species</th>
            <th>Author</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($genus->species as $species)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td style="font-style: italic">{{ $species->name }}</td>
                    <td>{{ $species->author }}</td>                    
                    <td><a href="{{ route('species', $species->id) }}">Show details</a></td>                    
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection