@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
				            <select class="form-control" name="family_select">
				            @foreach($families as $family)
				                <option value="{{$family->id}}">{{$family->name}}</option>
			                @endforeach
				            </select>
				        </div>

                    	<div class="form-group">            
				            <input type="text" name="name" class="form-control" placeholder="Name">				              
				        </div>
				         
				        <div class="form-group">
				            <button type="submit" class="btn btn-primary">Save Family</button>
				        </div>

                        {{ csrf_field() }}
                    </form>
                </div
            </div>

        </div>
    </div>
</div>
@endsection