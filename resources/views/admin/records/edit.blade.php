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
       
        <form method="POST" action="{{ route('admin.record.update') }}">

            <input type="hidden" name="record_id" value="{{ $record->id }}">
        		        
            <div class="form-group">            
                <label>Select species:</label>
                <species-select :pred_species="{{ $record->species_id }}"></species-select>                       
            </div>

            <paper-select :pred_paper="{{ $record->paper_id }}"></paper-select>

            <div class="form-group">
                <label for="recorded_as">Recorded as:</label>            
                <input type="text" name="recorded_as" class="form-control" value="{{ $record->recorded_as }}">
            </div>

            <div class="form-group">            
                <label for="locality_id">Select locality:</label>
                <locality-select :pred_loc="{{ $record->locality_id }}"></locality-select>    
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
                <input type="text" name="males_juv" class="form-control" placeholder="juv. males" value="{{ $record->juvenile_males ?: '' }}" style="display: inline; width: 120px;">                      
                <input type="text" name="females_juv" class="form-control" placeholder="juv. females" value="{{ $record->juvenile_females ?: '' }}" style="display: inline; width: 120px;">                     
            </div>

            <div class="form-group">      
                <input type="text" name="collected_by" class="form-control" placeholder="collected by">                     
            </div>

            <div class="input-group">
                <label for="datepicker">Select date:</label>
                <input type="text" class="form-control" id="datepicker" name="datepicker" value="{{ $record->collected_at ? $record->collected_at->format('d-m-Y') : '' }}">
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