@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1><i style="font-weight: bold">{{ $family->name }}</i> - list of genera</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Genus</th>
            <th>Author</th>
            <th>Species</th>
            <th>List</th>
          </tr>
        </thead>
        <tbody>
            @foreach($family->genera as $genus)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td style="font-style: italic; font-size: 1.2em; font-weight: bold;">{{ $genus->name }}</td>
                    <td>{{ $genus->author }}</td>
                    <td>{{ $genus->species_count }}</td>
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