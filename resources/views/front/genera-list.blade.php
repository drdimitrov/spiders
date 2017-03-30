@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>List of all genera</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Genus</th>
            <th>Author</th>
            <th>List</th>
          </tr>
        </thead>
        <tbody>
            @foreach($genera as $genus)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $genus->name }}</td>
                    <td>
                      <a href="{{ route('literature.single', $genus->paper->slug) }}">
                      @foreach($genus->paper->authors as $author)
                        {{ $author->first_name }} {{ $author->last_name }}, 
                      @endforeach
                      {{ $genus->paper->published_at->format('Y') }}
                      </a>
                    </td>
                    <td>
                        <a href="{{ route('species.genus', $genus->slug) }}">Species</a>
                    </td>
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection
