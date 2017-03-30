@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        <h3>Add new genus:</h3>

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
       
        <form method="POST" action="{{ route('admin.genus.create') }}">

            <paper-select></paper-select>

            <div class="form-group">                            
	            <label for="sel1">Select family:</label>            
	            <family-select></family-select>
	        </div>

        	<div class="form-group">            
	            <input type="text" name="name" class="form-control" placeholder="Name">				              
	        </div>
	         
	        <div class="form-group">
	            <button type="submit" class="btn btn-primary">Save Genus</button>
	        </div>

            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection