@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Add new locality:</div>

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

            <form action="{{ route('admin.locality.create') }}" method="POST">
            	<div class="form-group">
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
                <div class="form-group">
                    <input type="text" name="latitude" class="form-control" placeholder="latitude">
                </div>
                <div class="form-group">
                    <input type="text" name="longitude" class="form-control" placeholder="longitude">
                </div>
                <div class="form-group">
                    <label for="region_id">Select region:</label>
                    <select class="form-control" name="region_id">
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" >
                            {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="country_id">Select country:</label>
                    <select class="form-control" name="country_id">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" >
                            {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Locality</button>
		        </div>

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>
@endsection