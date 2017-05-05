@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit species:</div>

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
            
            <form action="/admin/species/edit" method="POST">
            	<div class="form-group">
                    <label for="name">Name:</label>            
		            <input type="text" name="name" class="form-control" value="{{ $species->name }}">
		        </div>
                <div class="form-group">
                    <label for="name">Author:</label>            
                    <input type="text" name="author" class="form-control" value="{{ $species->author }}">
                </div>
		        <div class="form-group">
                    <label for="slug">Slug:</label>           
		            <input type="text" name="slug" class="form-control" value="{{ $species->slug }}">
		        </div>
                
                <div class="form-group">
                    <label for="genus_id">Genus:</label>
                    <select class="form-control" name="genus_id">
                        @foreach($genera as $genus)
                            <option value="{{ $genus->id }}" @if($species->genus->id == $genus->id) selected @endif>{{ $genus->name }}</option>
                        @endforeach
                    </select>
                </div>

		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Genus</button>
		        </div>

                <input type="hidden" name="id" value="{{ $species->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection