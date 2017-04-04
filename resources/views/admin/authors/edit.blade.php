@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit author:</div>

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
            
            <form action="/admin/authors/edit" method="POST">
            	<div class="form-group">            
		            <input type="text" name="first_name" class="form-control" value="{{ $author->first_name }}">
		        </div>
		        <div class="form-group">            
		            <input type="text" name="last_name" class="form-control" value="{{ $author->last_name }}">
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Author</button>
		        </div>

                <input type="hidden" name="id" value="{{ $author->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection