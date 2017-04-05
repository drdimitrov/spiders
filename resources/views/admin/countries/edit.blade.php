@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit country:</div>

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
            
            <form action="/admin/country/edit" method="POST">
            	<div class="form-group">
                    <label for="name">Name:</label>           
		            <input type="text" name="name" class="form-control" value="{{ $country->name }}">
		        </div>
		        <div class="form-group">
                <label for="slug">Slug:</label>            
		            <input type="text" name="slug" class="form-control" value="{{ $country->slug }}">
		        </div>
                
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Country</button>
		        </div>

                <input type="hidden" name="id" value="{{ $country->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection