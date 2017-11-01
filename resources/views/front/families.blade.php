@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>List of all families <span style="font-size: 0.5em">({{ count($families) }} families, {{ $generaCount }} genera, {{ $speciesCount }} species)</span></h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Family</th>
            <th>Author</th>
            <th>Genera</th>
            <th>Species</th>
            <th>List</th>
          </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td style="font-style: italic; font-size: 1.2em; font-weight: bold;">{{ $family->name }}</td>
                    <td>{{ $family->author }}</td>
                    <td>{{ $family->genera_count }}</td>
                    <td>{{ $family->species_count }}</td>
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
