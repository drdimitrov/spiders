@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
   
    <div class="page-header">
      <h1 style="display: inline">Localities in {{ $country->name }}</h1>
      <a href="{{ route('stat.countries') }}" class="btn btn-default pull-right">Back to all countries</a>
    </div>

    <div id="map" style="width: 100%; height: 500px;"></div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nr.</th>
          <th>Locality</th>
          <th>Action</th>            
        </tr>
      </thead>
      <tbody>
          @foreach($country->localities as $locality)
              <tr>
                  <td>{{ $cnt }}</td>
                  <td>{{ $locality->name }}</td>
                  <td>                       
                    <a href="/statistics/species-by-locality/{{ $locality->id }}" class="btn btn-default">Show species</a>
                  </td>
              </tr>
              @php($cnt++)
          @endforeach          
      </tbody>
    </table>
    
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA41cF0sttrkX2sC2iwpBp5cyr6aFAIKJM&callback=initMap"
  type="text/javascript"></script>
<script>
    let countryCenter = {
      bulgaria : {
        zoom : 7,
        latitude : 42.699304,
        longitude : 25.403250
      },
      turkey : {
        zoom : 7,
        latitude : 41.413901,
        longitude : 27.816395
      },
      greece : {
        zoom : 6,
        latitude : 39.916719,
        longitude : 23.732175
      }
    };

    initMap = function(){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: countryCenter.{{ $country->slug }}.latitude, 
          lng: countryCenter.{{ $country->slug }}.longitude
        },
        scrollwheel: false,
        zoom: countryCenter.{{ $country->slug }}.zoom
      });

    @foreach($country->localities as $locality)
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
  </script>
@endsection