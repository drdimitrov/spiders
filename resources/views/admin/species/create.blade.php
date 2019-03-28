@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add new species:</div>

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
        <div>
        <ul class="nav nav-tabs" role="tablist">
            {{-- <li role="presentation" class="active"><a href="#custom" aria-controls="home" role="tab" data-toggle="tab">Custom</a></li> --}}
            <li role="presentation"><a href="#lsid" aria-controls="profile" role="tab" data-toggle="tab">LsId</a></li>
        </ul>

        <div class="tab-content">
        {{-- <div role="tabpanel" class="tab-pane active" id="custom">
                    <form method="POST" action="{{ route('admin.species.create') }}">

                        <div class="form-group">
                            <label>Select genus:</label>
                            <genus-select></genus-select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input type="text" name="author" class="form-control" placeholder="Author">
                        </div>

                        <div class="form-group">
                            <input type="text" name="wsc_lsid" class="form-control" placeholder="WSC LS id">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Species</button>
                        </div>

                        {{ csrf_field() }}
                    </form>
        </div> --}}
        <div role="tabpanel" class="tab-pane" id="lsid">
            <form method="POST" action="/admin/species/create-by-lsid">
                <div class="form-group">
                    <input type="text" name="wsc_lsid" class="form-control" placeholder="WSC LS id">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Species</button>
                </div>

                {{ csrf_field() }}
            </form>
        </div>
        </div>
        </div>

    </div>
</div>
@endsection