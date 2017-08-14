@extends('layouts.app')

@section('content')        
    <div class="panel panel-default">
        <div class="panel-heading">Edit family:</div>

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
            
            <form action="/admin/family/edit" method="POST">
            	<div class="form-group">
                    <label for="name">Name:</label>           
		            <input type="text" name="name" class="form-control" value="{{ $family->name }}">
		        </div>
		        <div class="form-group">
                <label for="slug">Slug:</label>            
		            <input type="text" name="slug" class="form-control" value="{{ $family->slug }}">
		        </div>
                 <div class="form-group">
                    <label for="author">Author:</label>          
                    <input type="text" name="author" class="form-control" value="{{ $family->author }}">
                </div>
                <div class="form-group">
                    <label for="author">WSC LsId:</label>          
                    <input type="text" name="wsc_lsid" class="form-control" value="{{ $family->wsc_lsid }}">
                </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Family</button>
		        </div>

                <input type="hidden" name="id" value="{{ $family->id }}">

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>   
@endsection