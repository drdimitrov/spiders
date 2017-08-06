@extends('layouts.main')

@section('content')
<div class="container">
	<div class="page-header">
		<h1 style="display: inline;">
			Literature 
			<a href="{{ route('literature') }}" class="btn btn-custom">All papers</a>
		</h1>		
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr>
					<td>
					@if(count($paper->authors) > 1)
						@foreach($paper->authors as $ka => $author)						
							@if($loop->first)
								{{ $author->last_name }}, {{ str_limit($author->first_name, 1, '') }}.,
							@else
								{{ str_limit($author->first_name, 1, '') }}. {{ $author->last_name }}
								@if(!$loop->last)
								,
								@endif
							@endif						
						@endforeach
					@else
						{{ $paper->authors[0]->last_name }}, {{ str_limit($paper->authors[0]->first_name, 1, '') }}.
					@endif
					</td>
					<td>{{ $paper->published_at->format('Y') }}</td>
					<td>{{ $paper->name }}</td>
					<td>{{ $paper->journal }}</td>
				</tr>			
			</table>
		</div>
	</div>
</div>
@endsection