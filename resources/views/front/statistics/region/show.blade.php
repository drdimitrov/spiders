@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>{{ $region->name }} - list of species</h1>        
      </div>

      <a href="/statistics/species-by-region" class="btn btn-primary pull-right">Back to regions</a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Species</th>
            <th>Localities in the region</th>
          </tr>
        </thead>
        <tbody>
            @foreach($species as $k => $s)              
                  <tr>
                      <td>{{ $cnt }}</td>
                      <td><a href="/species/{{ $k }}">{{ $s }}</a></td>
                      <td><a href="/species/{{ $k }}/{{ $region->id }}" class="btn btn-default">Show</a></td>
                  </tr>
                  @php($cnt++)             
            @endforeach          
        </tbody>
      </table>
</div>
@endsection
