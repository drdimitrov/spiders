@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Add new country:</div>

        <div class="panel-body">

           @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.country.create') }}" method="POST">
            	<div class="form-group">
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>

		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Country</button>
		        </div>

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>
@endsection