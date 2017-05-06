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
				({{ $loc['published'] }}); 
			@endforeach
			</p>
    	@endforeach
    </div>
    <div class="col-md-6">
    	<div id="map" style="width: 300px; height: 300px;"></div>
    </div>  
</div>

@endsection