@extends('layouts.app')

@section('title', 'Orders | Laravel Admin Website')

@section('content')

<div id="orders">
    <h5>Orders</h5>
    <br>
    <div>
        <div>
            <button type="button" id="add_order_btn" class="btn btn-success mr-1">Add order</button>
            <button type="button" id="edit_order_btn" class="btn btn-secondary edit-btn-disabled">Edit order</button>
        </div>
        <br>
        <table id="table-orders" class="table">
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Description</th>
                <th>Products</th>
                <th>Document</th>
                @if(Auth::user()->isAdministrator())
                <th>User_id</th>
                @endif
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
    <!-- Add Order Modal -->
    <div class="modal fade" id="add_table_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_order_modal_title">Add order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="add_table_form" class="pt-2 pl-2 pb-1" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <label for="add_title" class="col-form-label col-md-4">Title Order :&nbsp;</label>
                                <input value="" type="text" name="title" id="add_title" class="form-control modal-input col-md-8" maxlength="200">
                            </div>
                            <div id="add_validation-info-title" class="offset-md-4 col-md-8 p-1 validation-info">required, please add text, maximum of 250 charackters</div>
                            <div id="add_error-message-title" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="add_description" class="col-form-label col-md-4">Description Order :&nbsp;</label>
                                <textarea id="add_description" name="description" class="form-control" rows="5" cols="50" maxlength="5000" placeholder=""></textarea>
                            </div>
                            <div id="add_validation-info-description" class="offset-md-4 col-md-8 p-1 validation-info">please add text, maximum of 5000 charackters</div>
                            <div id="add_error-message-description" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="add_products" class="col-form-label col-md-4">Add product:&nbsp;</label>
                                <select name="products" id="add_products">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->id }} - {{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="add_validation-info-products" class="offset-md-4 col-md-8 p-1 validation-info">required, please select product</div>
                            <div id="add_error-message-products" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="add_document_upload" class="col-form-label col-md-4">Add document:&nbsp;</label>
                                <input type="file" name="document_upload" id="add_document_upload" class="form-control modal-input col-md-8">
                                <div id="add_validation-info-document_upload" class="offset-md-4 col-md-8 p-1 validation-info">please load document in one of these formats JPG</div>
                                <div id="add_error-message-document_upload" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                            </div>
                            <div class="input-group">
                                <label for="add_document_name" class="col-form-label col-md-4">Document:&nbsp;</label>
                                <input type="text" name="document_name" id="add_document_name" class="form-control modal-input col-md-8" disabled="disabled">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                            <button type="submit" id="add-confirm-btn" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="edit_table_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_order_modal_title">Edit order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_table_form" class="pt-2 pl-2 pb-1" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="edit_title" class="col-form-label col-md-4">Order Title :&nbsp;</label>
                                <input value="" type="text" name="title" id="edit_title" class="form-control modal-input col-md-8" maxlength="200">
                            </div>
                            <div id="edit_validation-info-title" class="offset-md-4 col-md-8 p-1 validation-info">required, please add text, maximum of 250 charackters</div>
                            <div id="edit_error-message-title" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="edit_description" class="col-form-label col-md-4">Order Description :&nbsp;</label>
                                <textarea id="edit_description" name="description" class="form-control" rows="5" cols="50" maxlength="5000" placeholder=""></textarea>
                            </div>
                            <div id="edit_validation-info-description" class="offset-md-4 col-md-8 p-1 validation-info">please add text, maximum of 5000 charackters</div>
                            <div id="edit_error-message-description" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="edit_products" class="col-form-label col-md-4">Add product:&nbsp;</label>
                                <select name="products" id="edit_products">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->id }} - {{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="edit_validation-info-products" class="offset-md-4 col-md-8 p-1 validation-info">required, please select product</div>
                            <div id="edit_error-message-products" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                            <div class="input-group">
                                <label for="edit_added_products" class="col-form-label col-md-4">Added products:&nbsp;</label>
                                <input type="text" name="added_products" id="edit_added_products" class="form-control modal-input col-md-8" disabled="disabled">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="edit_document_upload" class="col-form-label col-md-4">Add document:&nbsp;</label>
                                <input type="file" name="document_upload" id="edit_document_upload" class="form-control modal-input col-md-8">
                                <div id="edit_validation-info-document_upload" class="offset-md-4 col-md-8 p-1 validation-info">please load document in one of these formats JPG</div>
                                <div id="edit_error-message-document_upload" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                            </div>
                            <div class="input-group">
                                <label for="edit_document_name" class="col-form-label col-md-4">Document:&nbsp;</label>
                                <input type="text" name="document_name" id="edit_document_name" class="form-control modal-input col-md-8" disabled="disabled">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_edit-confirm-btn" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    <p class="confirm_delete_message" style="text-align: center;">Are you sure, you want to delete and order with title <span id="delete_title"></span>?</p>
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

            $(document).keypress(function(e) {
                if ($("#add_table_modal").hasClass('show') && (e.keycode == 13 || e.which == 13)) {
                    document.getElementById("add-confirm-btn").click();
                }
            });

        }); // end document ready

        $(document).delegate("#add_order_btn", "click", function(e){
            $('#add_table_modal').modal('show');
            $('.error-message').html('').hide();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add_table_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "/orders/add-entry",
                type:'POST',
                data: formData,
                dataType:'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data['status'] === undefined) {
                        if (data['title'] !== undefined) {
                            $('#add_error-message-title').html(data['title'][0]).fadeIn(700);
                        } else {
                            $('#add_error-message-title').html('');
                        }
                        if (data['description'] !== undefined) {
                            $('#add_error-message-description').html(data['description'][0]).fadeIn(700);
                        } else {
                            $('#add_error-message-description').html('');
                        }
                        if (data['products'] !== undefined) {
                            $('#add_error-message-products').html(data['products'][0]).fadeIn(700);
                        } else {
                            $('#add_error-message-products').html('');
                        }
                        if (data['document_upload'] !== undefined) {
                            $('#add_error-message-document_upload').html(data['document_upload'][0]).fadeIn(700);
                        } else {
                            $('#add_error-message-document_upload').html('');
                        }
                    } else if (data.status === 'success') {
                        $('.error-message').html('');
                        let datatable = createTable();
                        $('#add_table_modal').modal('hide');
                        $('#add_title').val('');
                        $('#add_description').val('');
                        $('#added_products').val('');
                        $('#add_document_name').val('');
                    }
                }
            });
        });

        $(document).delegate("#edit_order_btn", "click", function(e){
            let id = $('input[name="orders_table_radio"]:checked').val();
            editOrder(id);
        });

        $('#edit_table_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "/orders/edit-entry",
                type:'POST',
                data: formData,
                dataType:'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data['status'] === undefined) {
                        if (data['title'] !== undefined) {
                            $('#edit_error-message-title').html(data['title'][0]).fadeIn(700);
                        } else {
                            $('#edit_error-message-title').html('');
                        }
                        if (data['description'] !== undefined) {
                            $('#edit_error-message-description').html(data['description'][0]).fadeIn(700);
                        } else {
                            $('#edit_error-message-description').html('');
                        }
                        if (data['products'] !== undefined) {
                            $('#edit_error-message-products').html(data['products'][0]).fadeIn(700);
                        } else {
                            $('#edit_error-message-products').html('');
                        }
                        if (data['document_upload'] !== undefined) {
                            $('#edit_error-message-document_upload').html(data['document_upload'][0]).fadeIn(700);
                        } else {
                            $('#edit_error-message-document_upload').html('');
                        }
                    } else if (data.status === 'success') {
                        $('#edit_table_modal').modal('hide');
                        $('.error-message').html('').hide();
                        let datatable = createTable();
                        datatable.on('draw', function () {
                            $('#tbl_radio_btn_' + formData.get('id')).prop('checked', true);
                        });
                    }
                }
            });
        });


        $(document).delegate("#table-orders tr", "click", function(e){
            let id = $(this).data('id');
            $('#tbl_radio_btn_' + id).prop('checked', true);
            let radio_btn_state = 0;
            if (radio_btn_state === 0) {
                $('#edit_order_btn').removeClass("edit-btn-disabled");
            }
            radio_btn_state = 1;
        });

        $(document).delegate("#table-orders tr", "dblclick", function(e){
            let id = $(this).data('id');
            editOrder(id);
        });

        $(document).delegate(".delete_btn", "click", function(e){
            let id = $(this).data("id");
            let title = $(this).data("title");
            $('#confirmationModal').modal('show');
            $('#delete_title').html(title);
            $(document).delegate("#confirmation-modal-delete-button", "click", function(e){
                $('#confirmationModal').modal('hide');
                $.ajax({
                    url: '/orders/delete-data',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            $('#table-orders').DataTable().row("#order_id_" + id).remove().draw();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        function editOrder(id) {
            $.ajax({
                url: '/orders/data-to-update-entry',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function (data) {
                    $('#edit_id').val(id);
                    $('#edit_title').val(data.title);
                    $('#edit_description').val(data.description);
                    $('#edit_added_products').val(data.added_products);
                    $('#edit_document_name').val(data.document_name);
                    $('#edit_table_modal').modal('show');
                    $('.error-message').html('').hide();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function createTable() {
            $('#table-orders').DataTable().clear().destroy();
            let datatable = $('#table-orders').DataTable({
                "lengthChange": false,
                "searching": true,
                "bInfo" : false,
                "order": [[1, "asc"]],
                "pageLength": 10,
                "createdRow": function( row, data, dataIndex ) {
                    $(row).attr('id', 'order_id_' + data.id);
                    $(row).attr('data-id', data.id);
                },
                "ajax": {
                    "url": '/orders/table-data',
                    "data": {}
                },
                "language": {
                    "searchPlaceholder": "#title #description",
                },
                "columns": [
                    {"data": "radio_btn", "title": "", "orderable": false, "className": "text-center text-wrap radio_btn", "width": "10%"},
                    {"data": "title","title": "Title", "orderable": true, "searchable": true, "className": "text-left text-wrap", "width": "17%"},
                    {"data": "description","title": "Description", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "17%"},
                    {"data": "added_products", "title": "Products", "orderable": true, "className": "text-center text-wrap", "width": "17%"},
                    {"data": "document_name", "title": "Document", "orderable": false, "className": "text-center text-wrap", "width": "17%"},
                    @if(Auth::user()->isAdministrator())
                    {"data": "user_id", "title": "User_id", "orderable": false, "className": "text-center text-wrap", "width": "10%"},
                    @endif
                    {"data": "delete", "title": "", "orderable": false, "className": "text-center text-wrap", "width": "10%"},
                ],
            });

            return datatable;
        }


    </script>
@endsection




