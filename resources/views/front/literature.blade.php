@extends('layouts.main')

@section('content')
<div class="container">
	<div class="page-header">
		<h1 style="display: inline;">Literature</h1>
		<author class="pull-right"></author>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
			<!-- All the papers -->
			@if(isset($literature))
			  @foreach($literature as $lit)
				<tr>
					<td>
					@if(count($lit->authors) > 1)
						@foreach($lit->authors as $ka => $author)						
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
						{{ $lit->authors[0]->last_name }}, {{ str_limit($lit->authors[0]->first_name, 1, '') }}.
					@endif
					</td>
					<td>{{ $lit->published_at->format('Y') }}</td>
					<td><a href="/literature/{{ $lit->slug }}">{{ $lit->name }}</a></td>
					<td>{{ $lit->journal }}</td>
				</tr>
			  @endforeach
			 @endif
			
			<!-- Specific author's papers -->
			@if(isset($singleAuth))
				@foreach($singleAuth->first()->papers as $paper)
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
					<td><a href="/literature/{{ $paper->slug }}">{{ $paper->name }}</a></td>
					<td>{{ $paper->journal }}</td>
				@endforeach
			@endif
			</table>
		</div>
	</div>
</div>
@endsection