@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Add new locality:</div>

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

            <form action="{{ route('admin.locality.create') }}" method="POST">
            	<div class="form-group">
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
                <div class="form-group">
                    <input type="text" name="latitude" class="form-control" placeholder="latitude">
                </div>
                <div class="form-group">
                    <input type="text" name="longitude" class="form-control" placeholder="longitude">
                </div>
                <div class="form-group">
                    <label for="region_id">Select region:</label>
                    <select class="form-control" name="region_id" id="region_id">
                        <option></option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" >
                            {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="country_id">Select country:</label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option></option>                        
                    </select>
                </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Save Locality</button>
		        </div>

                {{ csrf_field() }}
            </form>
        </div
    </div>
</div>
@endsection

@section('admin-scripts')
<link href="{{ asset('vendor/select2/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('vendor/select2/select2.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#region_id, #country_id').select2();

    $('#region_id').on('select2:select', function (e) {
        $.post("{{ route('admin.ajax.countries-for-region') }}", {
            region: e.params.data.id
        }, function(data){

            $('#country_id').html('<option></option>');

            $.each(data, function(index, value){
                console.log(value.id, value.name)
                $('#country_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            })
        })
    });
</script>
@endsection