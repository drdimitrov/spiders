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

                    <h3>List of localities:</h3>

                    <a href="{{ route('admin.locality.create') }}" class="btn btn-success pull-right">Insert new locality</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nr.</th>
                                <th>Locality ID</th>
                                <th>Locality name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($nr=1)
                            @foreach($localities as $locality)
                            <tr>
                                <td>{{ $nr }}</td>
                                <td>{{ $locality->id }}</td>
                                <td>{{ $locality->name }}</td>
                                <td>
                                    <a href="{{ route('admin.locality.edit', $locality->id) }}" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-pencil "></span>
                                    </a>
                                </td>
                            </tr>
                            @php($nr++)
                            @endforeach
                        </tbody>
                    </table>

                    {{ $localities->links() }}
                </div
            </div>

        </div>
    </div>
</div>
@endsection