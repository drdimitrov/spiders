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

                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 20px">
                            <h3 style="display: inline-block;">List of regions:</h3>

                            <a href="{{ route('admin.region.create') }}" class="btn btn-success pull-right">Insert new region</a>
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
                        data: "id",
                        title: "Region ID",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                    },

                    {
                        data: "name",
                        title: "Region name",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,                       
                    },
                    

                    {
                        data: "countries",
                        title: "Countries",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                            var countries = [];
                            $.each(data, function(k, v){
                                countries.push(v.name);
                            });

                            return countries.join('/');
                        }                        
                    },                                                        

                    {
                        data: function (data, type, row) {
                            return '<i class="fas fa-edit"></i>';
                        },
                        title: "Edit",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<a href="/admin/region/edit/' + row.id + '">'  + data + '</a>';
                        }
                    },

                    {
                        data: function (data, type, row) {
                            return '<i class="fas fa-trash-alt"></i>';
                        },
                        title: "Delete",
                        className: "dt-nowrap dt-center",
                        searchable: false,
                        responsivePriority: 1,                       
                    },

                ],

                "ajax": {
                    url: "{{ route('admin.region') }}",
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

    //$('.dataTables_filter input').off();  
</script>
@endsection