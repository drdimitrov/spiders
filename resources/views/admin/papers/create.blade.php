@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Add new paper:</h3>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   
                    <form method="POST">
                        <author-select style="display: inline;"></author-select>

                        <div class="form-group" style="display: inline-block; ">            
                            <input type="text" name="published_at" class="form-control" placeholder="Year (2001)" style="width: 140px; display: inline;">
                        </div>
                        
                    	<div class="form-group">            
				            <textarea name="name" id="name" cols="30" rows="10" class="form-control"></textarea>				              
				        </div>
				        <div class="form-group">            
				            <input type="text" name="journal" class="form-control" placeholder="Journal">				              
				        </div>
				        <div class="form-group">
				            <button type="submit" class="btn btn-primary">Save Paper</button>
				        </div>

                        {{ csrf_field() }}
                    </form>
                </div
            </div>

        </div>
    </div>
</div>
@endsection