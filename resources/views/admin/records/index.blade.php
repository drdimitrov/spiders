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

                    <form action="" class="form-inline" method="get">
                        <species-select style="display: inline-block;"></species-select>
                        <input type="submit" value="Select" class="btn btn-primary" style="display: inline-block; position: absolute;">
                        <a href="/admin/records" class="btn btn-success pull-right" style="display: inline-block;"> All records</a>
                    </form>
					
					<ul class="list-group">
                    @foreach($records as $record)
						<li class="list-group-item">
                            {{ $record->species->genus->name}} {{ $record->species->name }} - {{ $record->locality->name }}
                            (
                            @if(count($record->paper->authors) > 1)
                                {{$record->paper->authors->first()->last_name}} et al.
                            @else
                                {{$record->paper->authors->first()->last_name}}
                            @endif
                            {{ $record->paper->published_at->format('Y') }})
                            <a href="{{ route('admin.record.edit', $record->id
                            ) }}">
                                <span class="glyphicon glyphicon-pencil pull-right"></span>
                            </a>
                        </li>
                    @endforeach
                    </ul>

                    {{ $records->appends(['species_id' => Request::get('species_id')])->links() }}
                </div
            </div>

        </div>
    </div>
</div>
@endsection
