@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add new genus:</div>

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
       
        <form method="POST" action="{{ route('admin.genus.create') }}">

            {{--<div class="form-group">                            --}}
	            {{--<label for="sel1">Select family:</label>            --}}
	            {{--<family-select></family-select>--}}
	        {{--</div>--}}

        	{{--<div class="form-group">            --}}
	            {{--<input type="text" name="name" class="form-control" placeholder="Name">--}}
	        {{--</div>--}}

            {{--<div class="form-group">            --}}
                {{--<input type="text" name="author" class="form-control" placeholder="Author">--}}
            {{--</div>--}}
	         {{----}}
	        {{--<div class="form-group">--}}
	            {{--<button type="submit" class="btn btn-primary">Save Genus</button>--}}
	        {{--</div>--}}

            <div class="form-group">
                <input type="text" name="wsc_lsid" class="form-control" placeholder="WSC lsId">
            </div>

            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection