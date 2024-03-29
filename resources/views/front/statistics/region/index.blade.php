@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>Species by region</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Region</th>
            <th>Countries</th>
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>
            @foreach($regions as $region)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $region->name }}</td>
                    <td>
                      @foreach($region->countries as $country)
                        {{ $country->name }}
                        @if(!$loop->last) , @endif
                      @endforeach
                    </td>
                    <td>                       
                      <a href="/statistics/species-by-region/{{ $region->id }}" class="btn btn-custom">Show species</a>
                    </td>
                </tr>
                @php($cnt++)
            @endforeach          
        </tbody>
      </table>
</div>
@endsection