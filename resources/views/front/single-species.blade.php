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
			@if($species->wsc_lsid)
			<div id="externalSrcs">
				<a href="http://wsc.nmbe.ch/speciesLsid/{{ $species->wsc_lsid }}" target="_blank" style="margin-right: 20px;">WSC <span class="glyphicon glyphicon-share-alt"></span></a>
			
				<a href="http://www.araneae.unibe.ch/speclsid/{{ $species->wsc_lsid }}" target="_blank">Araneae <span class="glyphicon glyphicon-share-alt"></span></a>
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
		
		@foreach($localities as $k => $locData) 
		<span>
		<b>{{ $k }}: </b>  
    	@foreach($locData['locality_details'] as  $localityi => $localityd) 
    		{{--dd($locData['locality_id'], $localityi, $localityd)--}}  		
			@foreach($localityd as  $loc)
				{{--To repair the link--}}
				{{--<a href="/statistics/species-by-locality/{{ $locData['locality_id'] }}" style="display: inline;">{{ $localityi }}</a> ---}}
					{{ $localityi }} -
				@if(isset($loc['notes'])) {{ $loc['notes'] }}, @endif
				@if(isset($loc['males'])) {{ $loc['males'] }} &#9794;,  @endif
				@if(isset($loc['females'])) {{ $loc['females'] }} &#9792;,  @endif
				@if(isset($loc['juveniles'])) {{ $loc['juveniles'] }} juv.,  @endif
				@if(isset($loc['juvenile_males'])) {{ $loc['juvenile_males'] }} juv. &#9794;,  @endif
				@if(isset($loc['juvenile_females'])) {{ $loc['juvenile_females'] }} juv. &#9792;,  @endif
				@if(isset($loc['date'])) {{ $loc['date'] }}, @endif
				@if(isset($loc['leg'])) {{ $loc['leg'] }} leg., @endif 
				(<a href="/literature/{{ $loc['slug'] }}" target="_blank" style="display: inline;">{{ $loc['published'] }}</a>);
					@if(isset($loc['coordinates']))
						@php($coordinates[] = $loc['coordinates'])
					@endif
				
			@endforeach
			
			</span>
    	@endforeach
    	@endforeach

    </div>
    <div class="col-md-6">
    	<div id="map" style="width: 100%; height: 400px;"></div>
		<div class="gdist">
			@if($species->gdist)
				<h4 style="display: inline-block">General distribution:</h4>
				{{$species->gdist}}
			@else
				@if($species->gdist_wsc)
					<h4 style="display: inline-block">General distribution (WSC):</h4>
					{{$species->gdist_wsc}}
				@endif
			@endif
		</div>
    </div>

    <div class=" row images">
    <h4>Images:</h4>
    @if(count($species->images))
    	@foreach($species->images as $image)
    	<div style="width: 160px; display: inline-block;" class="sp_img" title="{{ $species->genus->name }} {{ $species->name }}">
    		<img src="/storage/species/{{ $image->name  }}" width="150">
    		<p style="text-align: center;">{{$image->description}}</p>
    	</div>		
    	@endforeach
	@else
	<p>No images available yet.</p>
	@endif
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