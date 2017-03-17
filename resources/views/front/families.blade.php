@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>List of all families</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Family</th>
            <th>Author</th>
            <th>List</th>
          </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $family->name }}</td>
                    <td>
                        @foreach($family->paper->authors as $author)
                        <a href="{{ route('literature.single', $family->paper->slug) }}"  target="_blank">{{ $author->last_name }}, {{ $family->paper->published_at->format('Y') }}</a>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('genera.family', $family->slug) }}">Genera</a>
                    </td>
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection
