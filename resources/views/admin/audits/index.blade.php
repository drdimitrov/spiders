@extends('layouts.app')

@section('content')
<!-- Datatables Buttons extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_buttons/1.5.6/css/buttons.datatables.min.css') }}">

<!-- Datatables ColReorder extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_colreorder/1.5.0/css/colreorder.datatables.min.css') }}">

<!-- Datatables Fixed Header extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_fixedheader/3.1.4/css/fixedheader.datatables.css') }}">

<!-- Datatables Resposive extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_responsive/2.2.2/css/responsive.datatables.css') }}">

<!-- Datatables Scroller extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_scroller/2.0.0/css/scroller.datatables.css') }}">

<!-- Datatables Select extension style -->
<link rel="stylesheet" href="{{ asset('vendor/datatables_select/1.3.0/css/select.datatables.css') }}">

<link rel="stylesheet" href="{{ asset('css/datatables.css?') . date('Ymdh') }}">
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">Audit Logs</div>
               
                <div class="panel-body">
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
<!-- Remove default search input -->
<!-- <style>
	.dataTables_filter, .dataTables_info { display: none; }
</style> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.28/moment-timezone.min.js"></script> -->
<script>
	// Hide empty fields on form submit
	// $("form").submit(function() {
	// 	$(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
	// 	return true; // ensure form still submits
	// });

	// Decode the Json response
	function htmlDecode(input) {
		var doc = new DOMParser().parseFromString(input, "text/html");
		return doc.documentElement.textContent;
	}

    dataTable = $('table').DataTable({

                "order": [[ 2, "asc" ]],
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
                        data: "user.name",
                        title: "User Name",
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
                        	return data.name ? data.name : data.id
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

                    {
                        data: "created_at",
                        title: "Updated at",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        // render: function(data, type, row){
                        // 	return moment(data).format('DD-MM-YYYY HH:mm')
                        // }
                    },

                ],

                "ajax": {
                    url: "{{ route('admin.audit_logs') }}",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },                   
                }

            });
</script>
@endsection