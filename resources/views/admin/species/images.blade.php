@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add new image:</div>

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

        @if(Session::has('msg'))
			<div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif

        @if(Session::has('msg-err'))
            <div class="alert alert-danger">{{ Session::get('msg-err') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.species.images') }}" enctype="multipart/form-data">
            <div class="form-group">            
                <label>Select species:</label>
                <species-select></species-select>                       
            </div>

            <div class="form-group">  
                <input type="file" name="img" class="form-control">
            </div>

            <div class="form-group">
                <label>Description:</label> 
                <input type="text" name="description" class="form-control">
            </div>           
                         
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save file</button>
            </div>

            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection