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
            <th>Genera</th>
            <th>Species</th>
            <th>List</th>
          </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $family->name }}</td>
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
