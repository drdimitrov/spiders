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
								<th>Species ID</th>
								<th>Species name</th>
								<th>Synchronized at</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dailyUpdates as $update)
							<tr>
								<td>{{ $update->species->id }}</td>
								<td>
									{{ $update->species->genus->name . ' ' . $update->species->name }}
								</td>
								<td>{{ $update->created_at->format('d.m.Y') }}</td>
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