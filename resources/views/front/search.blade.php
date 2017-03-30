@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container search">
     <div class="page-header">
        <h1>Search for taxon</h1>
      </div>

      <form action="{{ route('taxon.search') }}" method="POST">
          <genus-select style="display: inline-block;"></genus-select>
          <button type="submit" class="btn btn-primary">Search</button>
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
