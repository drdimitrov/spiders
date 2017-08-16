@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome, {{ Auth::user()->name }}!
                </div
            </div>

        </div>
    </div>
</div>
@endsection
