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

    	@foreach($species->records as $record)
			<p>{{ $record->locality->name }}</p>
    	@endforeach
    </div>
    <div class="col-md-6">
    	<p>Google maps api</p>
    </div>  
</div>
@endsection