@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
	<div class="page-header">
		<h1>
			{{ $species->genus->name }} {{ $species->name }}

			<b>
			{{ $species->author }}
			</b>
		</h1>
	</div>

    <div class="col-md-6">
    	<h3>Localities:</h3>
		@php($coordinates = [])
    	@foreach($localities as $k => $locality)
    		<p>
    		<b>{{ $k }}: </b>
			@foreach($locality as $loc)
				{{ $loc['name'] }},
				@if(isset($loc['notes'])) {{ $loc['notes'] }}, @endif 				 
				@if(isset($loc['males'])) {{ $loc['males'] }} &#9794;,  @endif
				@if(isset($loc['females'])) {{ $loc['females'] }} &#9792;,  @endif
				@if(isset($loc['juvenile_males'])) {{ $loc['juvenile_males'] }} juv. &#9794;,  @endif
				@if(isset($loc['juvenile_females'])) {{ $loc['juvenile_females'] }} juv. &#9792;,  @endif
				@if(isset($loc['date'])) {{ $loc['date'] }}, @endif
				@if(isset($loc['leg'])) {{ $loc['leg'] }} leg., @endif 
				(<a href="/literature/{{ $loc['slug'] }}">{{ $loc['published'] }}</a>);
				@php($coordinates[] = $loc['coordinates']) 
			@endforeach
			</p>
    	@endforeach

    </div>
    <div class="col-md-6">
    	<div id="map" style="width: 500px; height: 400px;"></div>
    </div>  
</div>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA41cF0sttrkX2sC2iwpBp5cyr6aFAIKJM&callback=initMap"
  type="text/javascript"></script>
  @if(!empty($coordinates))
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

    @foreach($coordinates as $cd)
	    new google.maps.Marker({
	      position: {
	          lat: '{{$cd["0"]}}', 
	          lng: '{{$cd["1"]}}'
	        },
	      map: map,
	      title: '{{$cd["2"]}}'
	    });
    @endforeach

  }
  </script>
  @endif 
@endsection