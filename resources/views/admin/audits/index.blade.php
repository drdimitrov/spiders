@extends('layouts.app')

@section('content')
<!-- Datatables css overrides -->
<link rel="stylesheet" href="{{ asset('css/datatables.css?') . date('Ymdh') }}">
<link rel="stylesheet" href="{{ asset('vendor/datetimepicker/2.5.11/jquery.datetimepicker.min.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Audit Logs</div>
               
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline" action="" style="margin-bottom: 20px;">
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input autocomplete="off" type="text" class="form-control" name="date" id="recordDate" value="{{ request()->date }}" style="width: 120px;">
                                </div>
                                <div class="form-group">
                                    <label for="name">Admin:</label>
                                    <select name="admin" class="form-control">
                                        <option value=""></option>
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}"
                                                @if($admin->id == request()->name) selected @endif
                                            >
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="event">Event:</label>--}}
{{--                                    <select name="event" class="form-control">--}}
{{--                                        <option value=""></option>--}}
{{--                                        <option value="created" @if(request()->event == 'created') selected @endif>--}}
{{--                                            created--}}
{{--                                        </option>--}}
{{--                                        <option value="updated" @if(request()->event == 'updated') selected @endif>--}}
{{--                                            updated--}}
{{--                                        </option>--}}
{{--                                        <option value="deleted" @if(request()->event == 'deleted') selected @endif>--}}
{{--                                            deleted--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="model">Model:</label>--}}
{{--                                    <select name="model" class="form-control">--}}
{{--                                        <option value=""></option>--}}
{{--                                        <option value="Locality" @if(request()->model == 'Locality') selected @endif>--}}
{{--                                            Locality--}}
{{--                                        </option>--}}
{{--                                        <option value="Region" @if(request()->model == 'Region') selected @endif>--}}
{{--                                            Region--}}
{{--                                        </option>--}}
{{--                                        <option value="Record" @if(request()->model == 'Record') selected @endif>--}}
{{--                                            Record--}}
{{--                                        </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="obj">Object:</label>--}}
{{--                                    <input type="text" class="form-control" name="obj" value="{{ request()->obj }}">--}}
{{--                                </div>--}}

                                <button type="submit" id="submit_btn" class="btn btn-success" style="margin-left: 10px;">
                                    Filter
                                </button>
                                <a href="{{ route('admin.audit_logs') }}" class="btn btn-success">Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('admin-scripts')
<!-- Datatables base config  -->
<script src="{{ asset('js/datatables_base_config.js?') . date('Ymdh') }}"></script>

<!-- Moment js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.28/moment-timezone.min.js"></script> -->

{{--Datetimepicker--}}
<script src="{{ asset('vendor/datetimepicker/2.5.11/jquery.datetimepicker.full.min.js') }}"></script>

<script>
	//Hide empty fields on form submit
	$("form").submit(function() {
		$(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
		return true; // ensure form still submits
	});

	$('#recordDate').datetimepicker({
        dayOfWeekStart: 1,
        timepicker: false,
        format: "Y-m-d",
        value: "{{ request()->date }}",
        //maxDate: $('#to').val() ? $('#to').val() : moment().local().format(),
    });

	// Decode the Json response
	function htmlDecode(input) {
		var doc = new DOMParser().parseFromString(input, "text/html");
		return doc.documentElement.textContent;
	}

    dataTable = $('table').DataTable({

                //"order": [[ 3, "asc" ]],
                "serverSide": true,
                "processing": true,
                "pageLength": 25,

                "columns": [
                    {   // Responsive control column
                        defaultContent: '',
                        className: 'control',
                        responsivePriority: 1,
                        orderable: false,
                        searchable: true,
                        width: "20px",
                    },

                    {
                        data: "created_at",
                        title: "Date",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        render: function(data, type, row){
                            return moment(data).format('DD-MM-YYYY')
                        }
                    },  
                    
                    {
                        data: "user.name",
                        title: "Admin",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: true,                        
                    },

                    {
                        data: "event",
                        title: "Event",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: true,                        
                    },

                    {
                        data: "audit_type",
                        title: "Model",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,
                        searchable: true,
                        render: function (data, type, row) {
                            return data.replace('App\\', '');
                        }                       
                    },

                    {
                        data: "audit",
                        title: "Object",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,
                        render: function(data, type, row){
                        	//return data.name ? data.name : data.id
                        }
                    },
                    
                    {
                        data: "before",
                        title: "Value before",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                        	var output = [];
                        	$.each(JSON.parse(htmlDecode(data)), function(k, v){
                        		output.push('<p>' + k + ' : ' + v + '</p>')
                        	});

                        	return output.join('');           	
                        } 
                    },

                    {
                        data: "after",
                        title: "Value after",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,                        
                        render: function (data, type, row) {
                        	var output = [];
                        	$.each(JSON.parse(htmlDecode(data)), function(k, v){
                        		output.push('<p>' + k + ' : ' + v + '</p>')
                        	});

                        	return output.join('');           	
                        }                         
                    },                                      

                ],

                "ajax": {
                    url: "{{ route('admin.audit_logs') }}",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    data: function (d) {
                        d.admin = getUrlParameter('admin');
                        d.date = getUrlParameter('date');

                    }
                }

            });

	/**
     * getUrlParameter
     *
     * @param sParam
     */
    function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    }
</script>
@endsection