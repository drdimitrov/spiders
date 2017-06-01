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
                                      
                    <h3>List of records:</h3>
					
					<ul class="list-group">
                    @foreach($records as $record)
						<li class="list-group-item">
                            {{ $record->species->genus->name}} {{ $record->species->name }} - {{ $record->locality->name }} ({{ $record->paper->published_at->format('Y') }})
                            <a href="{{ route('admin.record.edit', $record->id) }}">
                                <span class="glyphicon glyphicon-pencil pull-right"></span>
                            </a>
                        </li>
                    @endforeach
                    </ul>

                    {{ $records->links() }}
                </div
            </div>

        </div>
    </div>
</div>
@endsection
