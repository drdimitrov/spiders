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
                                      
                    <h3>List of localities:</h3>
					
					<ul class="list-group">
                    @foreach($localities as $locality)
						<li class="list-group-item">
                            {{ $locality->name }}
                            <a href="{{ route('admin.locality.edit', $locality->id) }}">
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