@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Edit locality:</div>

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

            <form action="/admin/locality/edit" method="POST">
                <div class="row">                
                	<div class="col-md-6 form-group">
                        <label for="name">Name:</label>
    		            <input type="text" name="name" class="form-control" value="{{ $locality->name }}">
    		        </div>
    		        <div class="col-md-6 form-group">
                        <label for="slug">Slug:</label>
    		            <input type="text" name="slug" class="form-control" value="{{ $locality->slug }}">
    		        </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="latitude">Laitude:</label>
                        <input type="text" name="latitude" class="form-control" value="{{ $locality->latitude }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="longitude">Longitude:</label>
                        <input type="text" name="longitude" class="form-control" value="{{ $locality->longitude }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="region_id">Select region:</label>
                        <select class="form-control" name="region_id">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}"
                                    @if($region->id == $locality->region->id)
                                        selected
                                    @endif
                                >
                                {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="country_id">Select country:</label>
                        <select class="form-control" name="country_id">
                            @foreach($countries as $country)
                                <option  value="{{ $country->id }}"
                                    @if($country->id == $locality->country->id)
                                        selected
                                    @endif
                                >
                                {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Locality</button>
		        </div>

                <input type="hidden" name="id" value="{{ $locality->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>
@endsection