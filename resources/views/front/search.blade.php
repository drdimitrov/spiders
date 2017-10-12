@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container search"  id="app">
     <div class="page-header">
        <h1>Search for taxon</h1>
      </div>

      <form action="{{ route('taxon.search') }}" method="POST">
          <family-select style="display: inline-block;"></family-select>
          <button type="submit" class="btn btn-custom">Search</button>
          {{ csrf_field() }}
      </form>

      <form action="{{ route('taxon.search') }}" method="POST">
          <genus-select style="display: inline-block;"></genus-select>
          <button type="submit" class="btn btn-custom">Search</button>
          {{ csrf_field() }}
      </form>

      <form action="{{ route('taxon.search') }}" method="POST" style="position: relative;">
          <species-select style="display: inline-block;"></species-select>
          <button type="submit" class="btn btn-custom" style="position: absolute; margin-left: 4px;">Search</button>
          {{ csrf_field() }}
      </form>      
       
</div>

<script>
  new Vue({
    el : '.search',
    data : {
      genus : null      
    }
  })
</script>
@endsection
