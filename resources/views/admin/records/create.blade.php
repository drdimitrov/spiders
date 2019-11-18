@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Add new record:</div>

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

        @if(Session::has('msg'))
			<div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.record.create') }}">

            <div class="form-group">
                <label>Select species:</label>
                <species-select></species-select>
            </div>

            <paper-select style="width: 85%; display: inline-block;"></paper-select> 

            <div class="form-group" style="width: 10%; display: inline-block; margin-left: 10px;">
                <input type="text" name="page" class="form-control" placeholder="page">
            </div>

            <paper-rejected style="
                border: 1px solid #cccc99;
                border-radius: 5px; 
                padding-right: 5px;
                padding-left: 5px;"
            ></paper-rejected>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="recorded_as">Recorded as:</label>
                    <input type="text" name="recorded_as" class="form-control" >
                </div>

                <div class="col-md-4 form-group">
                    <label for="locality_id">Select locality:</label>
                    <locality-select></locality-select>
                </div>

                <div class="col-md-4 form-group">
                    <label for="altitude">Altitude (m):</label>
                    <input type="text" name="altitude" class="form-control" >
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" class="form-control" rows="5" id="notes"></textarea>
            </div>

            <div class="form-group" id="inps">
                <label>Number of specimens:</label>
                <input type="text" name="males" class="form-control" placeholder="males" style="display: inline; width: 120px;">
                <input type="text" name="females" class="form-control" placeholder="females" style="display: inline; width: 120px;">
                <input type="text" name="juveniles" class="form-control" placeholder="juveniles &#9794;,&#9792;" style="display: inline; width: 120px;">
                <input type="text" name="males_juv" class="form-control" placeholder="juv. &#9794;" style="display: inline; width: 120px;">
                <input type="text" name="females_juv" class="form-control" placeholder="juv. &#9792;" style="display: inline; width: 120px;">
                <input type="text" name="specimens" class="form-control" placeholder="specimens" style="display: inline; width: 120px;">
            </div>

            <div class="input-group">
                <label for="datepicker">Select date:</label>
                <input type="text" class="form-control" id="datepicker" name="datepicker">
            </div>
            <br>

            <!-- <div class="form-group">
                <label for="collection_id">Kept in collection:</label>
                <select class="form-control" name="collection_id">
                    <option value="0">No data</option>
                    <option value="1">NMNHS/B11</option>
                </select>
            </div> -->

	        <div class="form-group">
	            <button type="submit" class="btn btn-primary">Save Record</button>
	        </div>

            {{ csrf_field() }}
        </form>
    </div>
</div>

@endsection