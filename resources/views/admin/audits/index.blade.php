@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Audit Logs</div>
               
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 20px">
                            <h3 style="display: inline-block;">List of adjustments:</h3>
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
<script>
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
                        width: "0px",
                    },

                    {
                        data: "user.name",
                        title: "User",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,                        
                    },

                    {
                        data: "audit_type",
                        title: "Model",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                            return data.replace('App\\', '');
                        }                       
                    },

                    {
                        data: "audit.name",
                        title: "Object",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,
                    },
                    
                    {
                        data: "before",
                        title: "Value before",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        render: function (data, type, row) {
                        	var output = [];
                        	$.each(JSON.parse(htmlDecode(data)), function(k, v){
                        		output.push('<p>' + k + ':' + v + '</p>')
                        	});

                        	return output.join('');           	
                        } 
                    },

                    {
                        data: "after",
                        title: "Value after",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        raw: true,
                        render: function (data, type, row) {
                        	var output = [];
                        	$.each(JSON.parse(htmlDecode(data)), function(k, v){
                        		output.push('<p>' + k + ':' + v + '</p>')
                        	});

                        	return output.join('');           	
                        }                         
                    },

                    {
                        data: "updated_at",
                        title: "Updated at",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                    },

                ],

                "ajax": {
                    url: "{{ route('admin.audit_logs') }}",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    // data: function (d) {
                    //     d.user_id = getUrlParameter('user_id');
                    //     d.user_name = getUrlParameter('user_name');
                    //     d.user_currency = getUrlParameter('user_currency');
                    //     d.created_at_from = getUrlParameter('created_at_from');
                    //     d.created_at_to = getUrlParameter('created_at_to');
                    // }
                }

            });
</script>
@endsection