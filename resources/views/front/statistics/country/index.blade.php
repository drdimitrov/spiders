@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
    
   <div class="page-header">
      <h1>Localities by country</h1>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nr.</th>
          <th>Country</th>
          <th>Action</th>            
        </tr>
      </thead>
      <tbody>
          @foreach($countries as $country)
              <tr>
                  <td>{{ $cnt }}</td>
                  <td>{{ $country->name }}</td>
                  <td>                       
                    <a href="/statistics/localities-by-country/{{ $country->id }}" class="btn btn-custom">Show localities</a>
                  </td>
              </tr>
              @php($cnt++)
          @endforeach          
      </tbody>
    </table>
    
</div>
@endsection