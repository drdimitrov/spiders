@extends('layouts.main')

@section('content')
@php($cnt = 1)
@php($locs = [])
@php($spnum = [])
<div class="container">
     <div class="page-header">
        <h1 style="display: inline;">Localities in {{ $region->name }}</h1>
         {{-- {{  $allspecies }} species, Chao1 (expected species richness) =  {{ intval($chao1) }} --}}
        <button class="btn btn-custom chart-btn pull-right" data-toggle="modal" data-target="#chart">Chart</button>
      </div>   

      <div id="map" style="width: 100%; height: 500px;"></div>
      <br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Locality</th>
            <th>Species</th>
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>
            @foreach($region->localities as $locality)
            @php($locs[] = $locality->name)
            @php($spnum[] = count($locality->species))
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $locality->name }}</td>
                    <td>{{ count($locality->species) }}</td>
                    <td>                       
                      <a href="/statistics/species-by-locality/{{ $locality->id }}" class="btn btn-custom">Show species</a>
                    </td>
                </tr>
                @php($cnt++)
            @endforeach      
        </tbody>
      </table>

      <div id="app">
        <species-locality :locs="{{ collect($locs) }}" :species="{{ collect($spnum) }}"></species-locality>
      </div>
      
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA41cF0sttrkX2sC2iwpBp5cyr6aFAIKJM&callback=initMap"
  type="text/javascript"></script>
<script>

    initMap = function(){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: 41.865545, 
          lng: 27.966174
        },
        scrollwheel: false,
        zoom: 8
      });

    @foreach($region->localities as $locality)
      @if($locality->latitude && $locality->longitude)
      new google.maps.Marker({
        position: {
            lat: {{$locality->latitude}}, 
            lng: {{$locality->longitude}}
          },
        map: map,
        title: '{{$locality->name}}'
      });
      @endif
    @endforeach

  }

  new Vue({
      el : '#app',
      data : {
        locs : null,
        species:null      
      }
    });
  </script>
  <style>
    .modal-dialog{
      width: 90%;
    }

    #lchart{
      width: 100%;
    }
  </style>
@endsection