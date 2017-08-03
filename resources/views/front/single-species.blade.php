@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
	<div class="page-header">
		<h3 style="display: inline;">
			<i>{{ $species->genus->name }} {{ $species->name }}</i>

			<b>
			{{ $species->author }}
			</b>
		</h3>
		<div class="externalCit pull-right" style="display: inline;">
			@if($species->es_id || $species->wsc_id)
			<div id="externalSrcs">			
				@if($species->wsc_id)
					<a href="http://wsc.nmbe.ch/species/{{ $species->wsc_id }}" target="_blank" style="margin-right: 20px;">WSC <span class="glyphicon glyphicon-share-alt"></span></a>
					
				@endif
				@if($species->es_id)
					<a href="http://www.araneae.unibe.ch/data/{{ $species->es_id }}" target="_blank">EU Spiders <span class="glyphicon glyphicon-share-alt"></span></a>
									
				@endif
			</div>
	    	@endif
		</div>
	</div>

    <div class="col-md-6">
    	

		<!-- References -->
		<h4>Faunistic references:</h4>
		@foreach($references as $rfr)
		@foreach($rfr as $rfrKey => $rf)
			@foreach($rf as $refk => $reference)
			<p><i>{{$reference}}</i> <b><a href="/literature/{{$rfrKey}}">{{$refk}}</a></b></p>
			@endforeach
		@endforeach
		@endforeach
		<hr>
		<!-- End of references -->

    	<div></div>
    	<h4>Localities:</h4>
		@php($coordinates = [])
    	@foreach($localities as $k => $locality)
    		<p>
    		<b>{{ $k }}: </b>
			@foreach($locality as $kl => $locs)
				{{ $kl }} - 
				@foreach($locs as $loc)
				@if(isset($loc['notes'])) {{ $loc['notes'] }}, @endif 				 
				@if(isset($loc['males'])) {{ $loc['males'] }} &#9794;,  @endif
				@if(isset($loc['females'])) {{ $loc['females'] }} &#9792;,  @endif
				@if(isset($loc['juvenile_males'])) {{ $loc['juvenile_males'] }} juv. &#9794;,  @endif
				@if(isset($loc['juvenile_females'])) {{ $loc['juvenile_females'] }} juv. &#9792;,  @endif
				@if(isset($loc['date'])) {{ $loc['date'] }}, @endif
				@if(isset($loc['leg'])) {{ $loc['leg'] }} leg., @endif 
				(<a href="/literature/{{ $loc['slug'] }}" target="_blank">{{ $loc['published'] }}</a>);
					@if(isset($loc['coordinates']))
						@php($coordinates[] = $loc['coordinates'])
					@endif
				@endforeach
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
	          lat: {{$cd["0"]}}, 
	          lng: {{$cd["1"]}}
	        },
	      map: map,
	      title: '{{$cd["2"]}}'
	    });
    @endforeach

  }
  </script>
  @endif 
@endsection