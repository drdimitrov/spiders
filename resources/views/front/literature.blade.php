@extends('layouts.main')

@section('content')
<div class="container" id="app">
	<div class="page-header">
		<h1 style="display: inline;">
			Literature

			@if(request()->has('author')) 
				<a href="{{ route('literature') }}" class="btn btn-custom">All papers</a>
			@endif
		</h1>
		<author class="pull-right"></author>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
			<!-- All the papers -->
			@if(isset($references))
			  @foreach($references as $lit)
				<tr>
					<td class="col-md-2">{{ $lit['authors'] }}</td>
					<td>{{ $lit['published_at']->format('Y') }}</td>
					<td><a href="/literature/{{ $lit['slug'] }}">{{ $lit['name'] }}</a></td>
					<td>{{ $lit['journal'] }}</td>
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
			
			@if(isset($references))
				{{ $references->links() }}
			@endif

		</div>
	</div>
</div>
@endsection