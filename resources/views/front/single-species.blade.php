@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
	<div class="page-header">
		<h1>
			{{ $species->genus->name }} {{ $species->name }}

			<b>
			@foreach($species->paper->authors as $author)
				{{ $author->first_name }} {{ $author->last_name }}, 
			@endforeach
			{{ $species->paper->published_at->format('Y') }}
			</b>
		</h1>
	</div>

      
</div>
@endsection