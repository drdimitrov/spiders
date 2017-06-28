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
                                      
                    <h3>List of species:</h3>
					
					<ul class="list-group">
                    @foreach($species as $s)
						<li class="list-group-item">
                            {{ $s->name }} > {{ $s->genus->name }}
                            <a href="{{ route('admin.species.edit', $s->id) }}">
                                <span class="glyphicon glyphicon-pencil pull-right"></span>
                            </a>
                        </li>
                    @endforeach
                    </ul>

                    {{ $species->links() }}
                </div
            </div>

        </div>
    </div>
</div>
@endsection
