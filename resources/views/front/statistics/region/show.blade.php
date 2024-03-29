@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1 style="display: inline">{{ $region->name }} @if(Request::has('country') && Request::get('country') != 0) ({{\App\Country::find(Request::get('country'))->name}}) @endif- list of species</h1>
        <a href="/statistics/species-by-region" class="btn btn-custom pull-right">Back to regions</a>       
      </div>

      <form class="form-inline pull-right">
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="country">
            <option value="0" selected>All countries</option>
            @foreach($region->countries as $rc)
            <option value="{{ $rc->id }}" @if($rc->id == Request::get('country')) selected @endif>{{ $rc->name }}</option>
            @endforeach
          </select>
          <input type="submit" value="Filter" class="btn btn-custom">
      </form>

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
                      <td style="font-style: italic"><a href="/species/{{ $k }}">{{ $s }}</a></td>
                      <td><a href="/species/{{ $k }}/{{ $region->id }}" class="btn btn-custom">Show details</a></td>
                  </tr>
                  @php($cnt++)             
            @endforeach          
        </tbody>
      </table>

    <form action="/statistics/species-region-export" method="POST">
        <input type="hidden" name="region" value="{{$region->id}}">
        <input type="submit" value="Export" class="btn btn-primary pull-right">
        {{ csrf_field() }}
    </form>
</div>
@endsection
