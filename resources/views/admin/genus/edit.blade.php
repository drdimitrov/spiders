@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit genus:</div>

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
            
            <form action="/admin/genus/edit" method="POST">
            	<div class="form-group">
                    <label for="name">Name:</label>            
		            <input type="text" name="name" class="form-control" value="{{ $genus->name }}">
		        </div>
                <div class="form-group">
                    <label for="name">Author:</label>            
                    <input type="text" name="author" class="form-control" value="{{ $genus->author }}">
                </div>
		        <div class="form-group">
                    <label for="slug">Slug:</label>           
		            <input type="text" name="slug" class="form-control" value="{{ $genus->slug }}">
		        </div>
                
                <div class="form-group">
                    <label for="family_id">Family:</label>
                    <select class="form-control" name="family_id">
                        @foreach($families as $family)
                            <option value="{{ $family->id }}" @if($genus->family->id == $family->id) selected @endif>{{ $family->name }}</option>
                        @endforeach
                    </select>
                </div>

		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Genus</button>
		        </div>

                <input type="hidden" name="id" value="{{ $genus->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection