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
                <label for="species_id">Select species:</label>
                <select class="form-control" name="species_id">
                    @foreach($species as $s)
                        <option value="{{ $s->id }}" >
                        {{ $s->name }} > {{ $s->genus->name }}
                        </option>
                    @endforeach
                </select>                        
            </div>

            <paper-select></paper-select>

            <div class="form-group">
                <label for="recorded_as">Recorded as:</label>            
                <input type="text" name="recorded_as" class="form-control" >
            </div>

            <div class="form-group">            
                <label for="locality_id">Select locality:</label>
                <select class="form-control" name="locality_id">
                    @foreach($localities as $locality)
                        <option value="{{ $locality->id }}" >
                            {{ $locality->name }}
                        </option>
                    @endforeach
                </select>                        
            </div>

            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" class="form-control" rows="5" id="notes"></textarea>
            </div>

            <div class="form-group" id="inps">
                <label>Specimens:</label>            
                <input type="text" name="males" class="form-control" placeholder="males" style="display: inline; width: 120px;">
                <input type="text" name="females" class="form-control" placeholder="females" style="display: inline; width: 120px;">                      
                <input type="text" name="males_juv" class="form-control" placeholder="juv. males" style="display: inline; width: 120px;">                      
                <input type="text" name="females_juv" class="form-control" placeholder="juv. females" style="display: inline; width: 120px;">                     
            </div>

            <div class="form-group">      
                <input type="text" name="collected_by" class="form-control" placeholder="collected by">                     
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
                    <option value="">NMNHS/B11</option>                    
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