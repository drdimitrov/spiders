@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Add new region:</div>

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

            <form action="{{ route('admin.region.create') }}" method="POST">
            	<div class="form-group">
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>

                <div class="form-group">
                    <select multiple name="countries[]" class="form-control">
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Region</button>
		        </div>

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>
@endsection