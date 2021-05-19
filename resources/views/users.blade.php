@extends('layouts.app')

@section('title', 'Users | Laravel Admin Website')

@section('content')

<div id="users">
    <h5>Users</h5>
    <br>
    <div>
        <table id="table-users" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
    <!-- Confirm Delete Modal-->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm delete</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="confirm_delete_message" style="text-align: center;">Are you sure, že si prajete delete user s emailom <span id="delete_email"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                    <button id="confirmation-modal-delete-button" class="btn btn-danger btn-sm" type="button">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <link href="{{ asset("assets/libs/datatables/css/jquery.dataTables.min.css") }}" rel="stylesheet">
    <script src="{{ asset('assets/libs/bootstrap-4.5.3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset("assets/libs/datatables/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("assets/libs/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("assets/libs/datatables.net-responsive/js/dataTables.responsive.js") }}"></script>
    <script src="{{ asset("assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.js") }}"></script>
    <script>

    $(document).ready(function() {
        let datatable = createTable();
    });

    $(document).delegate(".delete_btn", "click", function(e){
        let id = $(this).data("id");
        $('#confirmationModal').modal('show');
        $('#delete_email').html($(this).data("email"));
        $(document).delegate("#confirmation-modal-delete-button", "click", function(e){
            $('#confirmationModal').modal('hide');
            $.ajax({
                url: '/users/delete-data',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function (data) {
                    if (data.status === 'success') {
                        $('#table-users').DataTable().row("#user_id_" + id).remove().draw();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    function createTable() {
        $('#table-users').DataTable().clear().destroy();
        let datatable = $('#table-users').DataTable({
            "lengthChange": false,
            "searching": true,
            "bInfo" : false,
            "order": [[1, "asc"]],
            "pageLength": 10,
            "createdRow": function( row, data, dataIndex ) {
                $(row).attr('id', 'user_id_' + data.id);
            },
            "ajax": {
                "url": '/users/table-data',
                "data": {}
            },
            "language": {
                "searchPlaceholder": "#name #email #role",
            },
            "columns": [
                {"data": "name","title": "Name", "orderable": true, "searchable": true, "className": "text-left text-wrap", "width": "10%"},
                {"data": "email","title": "Email", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "20%"},
                {"data": "role","title": "Role", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "20%"},
                {"data": "created", "title": "Created", "orderable": true, "searchable": false, "className": "text-center text-wrap", "width": "15%"},
                {"data": "delete", "title": "", "orderable": false, "searchable": false, "className": "text-center text-wrap", "width": "10%"},
            ],
        });

        return datatable;
    }


</script>
@endsection




