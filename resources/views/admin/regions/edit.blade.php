@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit region:</div>

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
            
            <form action="/admin/region/edit" method="POST">
            	<div class="form-group">
                    <label for="name">Name:</label>           
		            <input type="text" name="name" class="form-control" value="{{ $region->name }}">
		        </div>
		        <div class="form-group">
                <label for="slug">Slug:</label>            
		            <input type="text" name="slug" class="form-control" value="{{ $region->slug }}">
		        </div>

                <div class="form-group">            
                    <select multiple name="countries[]" class="form-control">
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            @if(in_array($country->id, $regionPlucked))
                                selected 
                            @endif
                        >
                        {{ $country->name }}
                        </option>
                        @endforeach
                    </select>                          
                </div>
                
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Region</button>
		        </div>

                <input type="hidden" name="id" value="{{ $region->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection