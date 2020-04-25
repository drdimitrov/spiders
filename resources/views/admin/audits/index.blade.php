@extends('layouts.app')

@section('content')
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
                        // render: function(data, type, row){
                        //  return moment(data).format('DD-MM-YYYY HH:mm')
                        // }
                    },  
                    
                    {
                        data: "user.name",
                        title: "User Name",
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

                ],

                "ajax": {
                    url: "{{ route('admin.audit_logs') }}",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },                   
                }

            });
</script>
@endsection