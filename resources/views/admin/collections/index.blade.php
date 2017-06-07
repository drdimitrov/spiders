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
                                      
                    <h3>List of collections:</h3>
					
					<ul class="list-group">
                    @foreach($collections as $collection)
						<li class="list-group-item">
                            {{ $collection->place }}
                            <a href="#">
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