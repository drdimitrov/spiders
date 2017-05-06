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
                                      
                    <h3>List of genera:</h3>
					
					<ul class="list-group">
                    @foreach($genera as $genus)
						<li class="list-group-item">
                            {{ $genus->name }}
                            <a href="{{ route('admin.genus.edit', $genus->id) }}">
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
