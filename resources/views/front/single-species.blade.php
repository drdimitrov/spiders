@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">

@php($cnt = 1)
<div class="container">
	<div class="page-header">
		<h3 style="display: inline;">
			<i>{{ $species->genus->name }} {{ $species->name }}</i>

			<b>
			{{ $species->author }}
			</b>
			<br>
			<span style="display: inline-block; font-size: .7em; margin-top: 15px;">
			Family <a href="/genera/show/{{$species->genus->family->slug}}">{{$species->genus->family->name}}</a> /
			Genus <a href="/species/show/{{$species->genus->slug}}">{{$species->genus->name}}</a>
		</span>
		</h3>

		<div class="externalCit pull-right" style="display: inline;">
			@if($species->wsc_lsid)
			<div id="externalSrcs">
				<a href="https://wsc.nmbe.ch/speciesLsid/{{ $species->wsc_lsid }}" target="_blank" style="margin-right: 20px;">WSC <span class="glyphicon glyphicon-share-alt"></span></a>

				<a href="https://araneae.nmbe.ch/speclsid/{{ $species->wsc_lsid }}" target="_blank">Araneae <span class="glyphicon glyphicon-share-alt"></span></a>
			</div>
	    	@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right col-md-6" style="background: #ddddbb; padding-top: 10px">
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

			<!-- References -->
			<h4>Faunistic references:</h4>
			@foreach($references as $kref => $ref)
				@foreach($ref as $kr => $vr)
					@foreach($vr as $rfr)
					@foreach($rfr as $r)
						<p><i>{{$r['as']}}</i>
							<b>
								<a href="/literature/{{$r['slug']}}">
									{{ $kr }} {{ $kref }}@if(isset($r['page'])), p. {{ $r['page'] }}@endif
								</a>
							</b>
						</p>
					@endforeach
					@endforeach
				@endforeach
			@endforeach
			<hr>
			<!-- End of references -->

			<div></div>
			<h4>Localities:</h4>
			@php($coordinates = [])

			@foreach($localities as $k => $locs)
			<span>
			<b>{{ $k }}: </b>
				@foreach($locs as $kloc => $loc)
				<a href="/statistics/species-by-locality/{{ $kloc }}" style="display: inline;">{{ $loc['locality_name'] }}</a> -
					@foreach($loc['records'] as $ll)
						@if(isset($ll['specimens'])) {{ $ll['specimens'] }} specimens,  @endif
						@if(isset($ll['males'])) {{ $ll['males'] }} &#9794;,  @endif
						@if(isset($ll['females'])) {{ $ll['females'] }} &#9792;,  @endif
						@if(isset($ll['juveniles'])) {{ $ll['juveniles'] }} juv.,  @endif
						@if(isset($ll['juvenile_males'])) {{ $ll['juvenile_males'] }} juv. &#9794;,  @endif
						@if(isset($ll['juvenile_females'])) {{ $ll['juvenile_females'] }} juv. &#9792;,  @endif
						@if(isset($ll['date'])) {{ $ll['date'] }}, @endif
						@if(isset($ll['leg'])) {{ $ll['leg'] }} leg., @endif
						@if(count($ll['paper']->first()->authors) > 2)
							{{$ll['paper']->first()->authors->first()->last_name}} et al.
						@elseif(count($ll['paper']->first()->authors) == 2)
							@foreach($ll['paper']->first()->authors as $a)
								{{ $a->last_name }} @if(!$loop->last) & @endif
							@endforeach
						@else
							{{$ll['paper']->first()->authors->first()->last_name}}
						@endif
						{{ str_limit($ll['paper']->first()->published_at, 4, '') }}
						@if(isset($ll['notes']))({{ $ll['notes'] }})@endif;
						@if(isset($ll['coordinates']))
							@php($coordinates[] = $ll['coordinates'])
						@endif
					@endforeach
				@endforeach
				<br>
			</span>
			@endforeach

		</div>
		<!-- The OLD place of the map -->
	</div>
    <div class=" row images">
		<div class="col-md-12">
			<h4>Images:</h4>
			@if(count($species->images))
				@foreach($species->images as $image)
				<div style="display: inline-block;">
					<a class="single_image"  class="sp_img" href="/storage/species/{{ $image->name  }}" title="{{ $species->genus->name }} {{ $species->name }}">
						<img src="/storage/species/{{ $image->name  }}" width="150">
					</a>

					<p style="width: 160px; text-align: center;">{{$image->description}}</p>
				</div>
				@endforeach
			@else
			<p>No images available yet.</p>
			@endif
		</div>
    </div>
</div>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_SEARCH_API_KEY') }}"
  type="text/javascript"></script>
  @if(!empty($coordinates))
  <script>
    initMap = function(){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: 42.475545,
          lng: 25.436174
        },
        scrollwheel: false,
        zoom: 6.8
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

@push('custom-scripts')
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js"></script>
	<script>
	console.log($('.single_image'))
		$('.single_image').fancybox({
            type : 'image'
        });
	</script>
	<style>
	    .fancybox-content a.single_image, .fancybox-content a.single_image img {
          width: 500px;
          max-width: none;
          max-height: none;
        }
	</style>
@endpush
