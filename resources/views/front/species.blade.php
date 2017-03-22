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
                    <td>{{ $species->name }}</td>
                    <td>                    
                        @foreach($species->paper->authors as $author)
                        <a href="{{ route('literature.single', $genus->paper->slug) }}"  target="_blank">{{ $author->last_name }}, </a>
                        @endforeach
                        {{ $genus->paper->published_at->format('Y') }}
                    </td>                    
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection