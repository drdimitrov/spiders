@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Synchronized taxa</div>
               
                <div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Synchronization date</th>
								<th>Species name</th>		
								<th>Species ID</th>
								<th>Source</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dailyUpdates as $update)
							<tr>
								<td>{{ $update->created_at->format('d.m.Y') }}</td>
								<td>
									<a target="_blank" href="{{ route('species', $update->species->id) }}">{{ $update->species->genus->name . ' ' . $update->species->name }}</a>
								</td>
								<td>{{ $update->species->id }}</td>								
								<td>WSC</td>								
							</tr>
							@endforeach						
						</tbody>
					</table>

					{{ $dailyUpdates->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection