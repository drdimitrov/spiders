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
                    <form action="" class="form-inline" method="get">
                        <species-select style="display: inline-block;"></species-select>
                        <input type="submit" value="Select" class="btn btn-primary" style="display: inline-block; position: absolute;">
                        <a href="/admin/species" class="btn btn-success pull-right" style="display: inline-block;"> All species</a>
                    </form>

					<ul class="list-group">
                    @foreach($species as $s)
						<li class="list-group-item">
                            {{ $s->name }} > {{ $s->genus->name }}
                            <div class="pull-right">
                                <a href="{{ route('admin.species.edit', $s->id) }}" style="margin-right: 10px;">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="{{ route('admin.species.delete', $s->id) }}">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                    </ul>

                    {{ $species->appends(['species_id' => Request::get('species_id')])->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
