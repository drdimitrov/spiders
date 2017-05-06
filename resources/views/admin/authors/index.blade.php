@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if(Session::has('msg-success'))
                    {{ Session::get('msg-success') }}
                @endif
                <div class="panel-body">
                    <author style="display: inline;"></author>
                    <a href="{{ route('admin.authors') }}" class="btn btn-success">All authors</a> 
                    <a href="{{ route('admin.authors.create') }}" class="btn btn-success pull-right">Insert new author</a>
                    
                    <h3>List of authors:</h3>
					
					<ul class="list-group">
                    @foreach($authors as $author)
						<li class="list-group-item">
                            {{ $author->last_name }}, {{ $author->first_name }}
                            <a href="{{ route('admin.authors.edit', $author->id) }}">
                                <span class="glyphicon glyphicon-pencil pull-right"></span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div
            </div>

        </div>
    </div>
</div>
@endsection
