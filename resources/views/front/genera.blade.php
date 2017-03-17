@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>List of {{ $family->name }} genera</h1>
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
            @foreach($family->genera as $genus)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $genus->name }}</td>
                    <td>                    
                        @foreach($genus->paper->authors as $author)
                        <a href="{{ route('literature.single', $genus->paper->slug) }}"  target="_blank">{{ $author->last_name }}, {{ $genus->paper->published_at->format('Y') }}</a>
                        @endforeach
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