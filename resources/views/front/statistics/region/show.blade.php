@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1 style="display: inline">{{ $region->name }} - list of species</h1>
        <a href="/statistics/species-by-region" class="btn btn-primary pull-right">Back to regions</a>       
      </div>

      <form class="form-inline pull-right">
          <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="country">
            <option selected>Select country</option>
            @foreach($region->countries as $rc)
            <option value="{{ $rc->id }}">{{ $rc->name }}</option>
            @endforeach
          </select>
          <input type="submit" value="Filter" class="btn btn-primary">
      </form>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Species</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($species as $k => $s)              
                  <tr>
                      <td>{{ $cnt }}</td>
                      <td><a href="/species/{{ $k }}">{{ $s }}</a></td>
                      <td><a href="/species/{{ $k }}/{{ $region->id }}" class="btn btn-default">Show details</a></td>
                  </tr>
                  @php($cnt++)             
            @endforeach          
        </tbody>
      </table>
</div>
@endsection
