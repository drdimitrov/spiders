@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>List of localities</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Locality</th>
            <th>Region</th>
            <th>Country</th>
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>
            @foreach($localities as $locality)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $locality->name }}</td>
                    <td>{{ $locality->region->name }}</td>
                    <td>{{ $locality->country->name }}</td>
                    <td>                       
                      <a href="/statistics/species-by-locality/{{ $locality->id }}" class="btn btn-default">Show species</a>
                    </td>
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection