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

                    <h3>List of papers:</h3>

                    <a href="{{ route('admin.papers.create') }}" class="btn btn-success pull-right">Insert new paper</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Authors</th>
                                <th>Year</th>
                                <th>Paper name</th>
                                <th>Journal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($papers as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td>
                                    @foreach($paper->authors as $author)
                                    {{ $author->last_name }}
                                        @if(!$loop->last)
                                         & &nbsp;
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $paper->published_at->format('Y') }}</td>
                                <td>{{ $paper->name }}</td>
                                <td>{{ $paper->journal }}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.locality.edit', $locality->id) }}" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-pencil "></span>
                                    </a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $papers->links() }}
                </div
            </div>

        </div>
    </div>
</div>
@endsection