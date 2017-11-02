@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    @if(Session::has('msg-success'))
                        {{ Session::get('msg-success') }}
                    @endif
                    <div class="panel-body">

                        <h3>Delete species:</h3>
                        <div class="alert alert-danger">
                            You are about to delete <strong><i>{{$species->genus->name}} {{$species->name}}</i></strong>.
                            Are you sure?
                        </div>

                        <form action="/admin/species/delete" class="form-inline" method="post">
                            <input type="hidden" name="species" value="{{$species->id}}">
                            <input type="submit" value="Yes, I am." class="btn btn-success" style="display: inline-block; position: absolute;">
                            {{csrf_field()}}
                        </form>

                        <a href="/admin/species" class="btn btn-danger pull-right">Cancel</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
