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
                            <h3 style="display: inline-block;">List of papers:</h3>

                            <a href="{{ route('admin.papers.create') }}" class="btn btn-success pull-right">Insert new paper</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
    dataTable = $('table').DataTable({

                "order": [[ 1, "asc" ]],
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
                        title: "Paper ID",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                    },

                    {
                        data: "authors",
                        title: "Authors",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                            var authors = [];
                            $.each(data, function(index, value){
                                authors.push(value.last_name)
                            })
                            return authors.join(', ');
                        }                         
                    },

                    {
                        data: "published_at",
                        title: "Year",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,
                        render: function (data, type, row) {
                            return moment(data).year();
                        }                        
                    },

                    {
                        data: "name",
                        title: "Title",
                        className: "dt-nowrap dt-bold",
                        responsivePriority: 1,                        
                        render: function (data, type, row) {
                            return data.substring(0, 40) + ' ...';
                        }                                            
                    }, 

                    // {
                    //     data: "journal",
                    //     title: "Journal",
                    //     className: "dt-nowrap dt-bold",
                    //     responsivePriority: 1,
                    //     searchable: false,
                    //     render: function (data, type, row) {
                    //         return data.substring(0, 30) + ' ...';
                    //     }                                                
                    // },                                                        

                    {
                        data: function (data, type, row) {
                            return '<i class="fas fa-edit"></i>';
                        },
                        title: "Edit",
                        className: "dt-nowrap dt-center",
                        responsivePriority: 1,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<a href="/admin/papers/' + row.id + '/edit">'  + data + '</a>';
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
                    url: "{{ route('admin.papers') }}",
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