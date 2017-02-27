@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Add new author:</h3>
                   
                    <form action="{{ route('admin.authors.create') }}" method="POST">
                    	<div class="form-group">            
				            <input type="text" name="first_name" class="form-control" placeholder="First Name">				              
				        </div>
				        <div class="form-group">            
				            <input type="text" name="last_name" class="form-control" placeholder="Last Name">				              
				        </div>
				        <div class="form-group">
				            <button type="submit" class="btn btn-primary">Save Author</button>
				        </div>

                        {{ csrf_field() }}
                    </form>
                </div
            </div>

        </div>
    </div>
</div>
@endsection