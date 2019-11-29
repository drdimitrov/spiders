@extends('layouts.app')

@section('content')
      
<div class="panel panel-default">
    <div class="panel-heading">Update record:</div>

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
       
        <form method="POST" action="{{ route('admin.record.update') }}">

            <input type="hidden" name="record_id" value="{{ $record->id }}">
        		        
            <div class="form-group">            
                <label>Select species:</label>
                <species-select :pred_species="{{ $record->species_id }}"></species-select>                       
            </div>

            <paper-select :pred_paper="{{ $record->paper_id }}" style="width: 85%; display: inline-block;"></paper-select>

            <div class="form-group" style="width: 10%; display: inline-block; margin-left: 10px;">
                <input type="text" name="page" class="form-control" placeholder="page" value="{{$record->page}}">
            </div>

             <paper-rejected style="
                border: 1px solid #cccc99;
                border-radius: 5px; 
                padding-right: 5px;
                padding-left: 5px;"
            ></paper-rejected>

            <div class="form-group">
                <label for="recorded_as">Recorded as:</label>            
                <input type="text" name="recorded_as" class="form-control" value="{{ $record->recorded_as }}">
            </div>

            <div class="form-group">            
                <label for="locality_id">Select locality:</label>
                <locality-select :pred_loc="{{ $record->locality_id }}"></locality-select>    
            </div>

            <div class="form-group">
                <label for="altitude">Altitude (m):</label>
                <input type="text" name="altitude" class="form-control" value="{{$record->altitude}}">
            </div>

            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" class="form-control" rows="5" id="notes">
                    {{ $record->comments ?: '' }}
                </textarea>
            </div>

            <div class="form-group" id="inps">
                <label>Specimens:</label>            
                <input type="text" name="males" class="form-control" placeholder="males" value="{{ $record->males ?: '' }}" style="display: inline; width: 120px;">
                <input type="text" name="females" class="form-control" placeholder="females" value="{{ $record->females ?: '' }}" style="display: inline; width: 120px;">
                <input type="text" name="juveniles" class="form-control" placeholder="juveniles &#9794;,&#9792;" style="display: inline; width: 120px;" value="{{ $record->juveniles ?: '' }}">
                <input type="text" name="males_juv" class="form-control" placeholder="juv. &#9794;" value="{{ $record->juvenile_males ?: '' }}" style="display: inline; width: 120px;">
                <input type="text" name="females_juv" class="form-control" placeholder="juv. &#9792;" value="{{ $record->juvenile_females ?: '' }}" style="display: inline; width: 120px;">
                <input type="text" name="specimens" class="form-control" placeholder="specimens" value="{{ $record->specimens ?: '' }}" style="display: inline; width: 120px;">
            </div>

            <div class="input-group">
                <label for="datepicker">Select date:</label>
                <input type="text" class="form-control" id="datepicker" name="datepicker" value="{{ $record->collected_at ? $record->collected_at->format('d-m-Y') : '' }}" autocomplete="off">
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