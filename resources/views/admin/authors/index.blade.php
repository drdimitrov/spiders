@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if(Session::has('msg-success'))
                    {{ Session::get('msg-success') }}
                @endif
                <div class="panel-body">
                    <author></author>
                    
                    <h3>List of authors:</h3>
					
					<ul>
                    @foreach($authors as $author)
						<li>{{ $author->last_name }}, {{ $author->first_name }}</li>
                    @endforeach
                    </ul>
                </div
            </div>

        </div>
    </div>
</div>
@endsection
