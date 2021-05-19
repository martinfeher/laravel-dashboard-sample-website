@extends('layouts.app')

@section('title', 'Products | Laravel Admin Website')

@section('content')

<div id="products">
    <h5>Products</h5>
    <br>
    <div>
        <div>
            <button type="button" id="add_product_btn" class="btn btn-primary mr-1">Add product</button>
            <button type="button" id="edit_product_btn" class="btn btn-secondary edit-btn-disabled">Edit product</button>
        </div>
        <br>
        <table id="table-products" class="table">
            <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
    <!-- Add Edit Product Modal -->
    <div class="modal fade" id="add_edit_table_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_product_modal_title">Add product</h5>
                    <h5 class="modal-title" id="edit_product_modal_title">Edit product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-body pt-2 pl-2 pb-1">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="title" class="col-form-label col-md-4">Title:&nbsp;</label>
                                <input value="" type="text" name="title" id="title" class="form-control modal-input col-md-8" maxlength="200">
                            </div>
                            <div id="validation-info-title" class="offset-md-4 col-md-8 p-1 validation-info">required, please add text, maximum of 250 charackters</div>
                            <div id="error-message-title" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="description" class="col-form-label col-md-4">Description:&nbsp;</label>
                                <textarea id="description" name="description_textarea" class="form-control" rows="5" cols="50" maxlength="5000" placeholder=""></textarea>
                            </div>
                            <div id="validation-info-description" class="offset-md-4 col-md-8 p-1 validation-info">please add text, maximum of 5000 charackters</div>
                            <div id="error-message-description" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="price" class="col-form-label col-md-4">Price:&nbsp;</label>
                                <input value="" type="text" name="price" id="price" class="form-control modal-input col-md-8" maxlength="11">
                            </div>
                            <div id="validation-info-price" class="offset-md-4 col-md-8 p-1 validation-info">required, please add price</div>
                            <div id="error-message-price" class="alert alert-danger error-message offset-md-4 col-md-8 mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                            <button type="button" id="add-confirm-btn" class="btn btn-primary">Confirm</button>
                            <button type="button" id="edit-confirm-btn" class="btn btn-primary">Edit</button>
                            <!-- <div id="validation-info-description" class="offset-md-4 col-md-8 p-1 validation-info">please add text, maximum of 5000 charackters</div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Order Modal -->
    <div class="modal fade" id="create_order_table_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_order_modal_title">Create Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-body pt-4 px-4 pb-2">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="titlet_orders" class="col-form-label col-md-5">Order Title :</label>
                                <input value="" type="text" name="title_orders" id="title_orders" class="form-control modal-input col-md-7" maxlength="200">
                            </div>
                            <div id="validation-info-title_orders" class="offset-md-5 col-md-7 p-1 validation-info">required, please add text, maximum of 250 charackters</div>
                            <div id="error-message-title_orders" class="alert alert-danger error-message offset-md-5 col-md-7 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="description_orders" class="col-form-label col-md-5">Order Description :</label>
                                <textarea id="description_orders" name="description_orders_textarea" class="form-control" rows="5" cols="50" maxlength="5000" placeholder=""></textarea>
                            </div>
                            <div id="validation-info-description_orders" class="offset-md-5 col-md-7 p-1 validation-info">please add text, maximum of 5000 charackters</div>
                            <div id="error-message-description_orders" class="alert alert-danger error-message offset-md-5 col-md-7 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="product_modal" class="col-form-label col-md-5">Product</label>
                                <input value="" type="text" name="product_modal" id="product_modal" class="form-control modal-input col-md-7" maxlength="200" disabled>
                            </div>
                            <div id="validation-info-products" class="offset-md-5 col-md-7 p-1 validation-info"></div>
                            <div id="error-message-products" class="alert alert-danger error-message offset-md-4 col-md-á mt-2 p-1" style="font-size: 0.9em; display:none;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                            <button type="button" id="create_order_confirm-btn" class="btn btn-primary">Create Order</button>
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
                    <p class="confirm_delete_message" style="text-align: center;">Are you sure, you want to delte the product with id <span id="delete_id"></span>?</p>
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
            if ($("#add_edit_table_modal").hasClass('show') && (e.keycode == 13 || e.which == 13)) {
                document.getElementById("add-confirm-btn").click();
            }
        });

    });



    $(document).delegate("#add_product_btn", "click", function(e){
        $('#add_product_modal_title').show();
        $('#edit_product_modal_title').hide();
        $('#add-confirm-btn').show();
        $('#edit-confirm-btn').hide();
        $('#title').val('');
        $('#description').val('');
        $('#price').val('');
        $('.error-message').html('').hide();
        $('#add_edit_table_modal').modal('show');
    });

    $(document).delegate("#edit_product_btn", "click", function(e){
        $('#edit_product_modal_title').show();
        $('#add_product_modal_title').hide();
        $('.error-message').html('').hide();    
        $('#add_edit_table_modal').modal('show');
    });

    $(document).delegate(".create_order_btn", "click", function(e){
        $('#create_order_table_modal').modal('show');
        let id = $(this).data('id');
        let title = $(this).data('title');
        $('#product_modal').val('id: ' + id + ', ' + title);
        $('#create_order_confirm-btn').attr('data-product_id', String(id));
        $('.error-message').html('').hide();
    });

    $(document).delegate("#add-confirm-btn", "click", function(e){
        let title = $('#title').val();
        let description = $('#description').val();
        let price = $('#price').val();
        $.ajax({
            url: "/products/add-entry",
            type:'GET',
            dataType: "json",
            data: {
                title: title,
                description: description,
                price: price,
            },
            success: function(data) {
                if (data['status'] === undefined) {
                    if (data['title'] !== undefined) {
                        $('#error-message-title').html(data['title'][0]).fadeIn(700);
                    } else {
                        $('#error-message-title').html('');
                    }
                    if (data['description'] !== undefined) {
                        $('#error-message-description').html(data['description'][0]).fadeIn(700);
                    } else {
                        $('#error-message-description').html('');
                    }
                    if (data['price'] !== undefined) {
                        $('#error-message-price').html(data['price'][0]).fadeIn(700);
                    } else {
                        $('#error-message-price').html('');
                    }
                } else if (data.status === 'success') {
                    $('.error-message').html('').hide();
                    let datatable = createTable();
                    $('#add_edit_table_modal').modal('hide');
                    $('#title').val('');
                    $('#description').val('');
                    $('#price').val('');
                }
            }
        });
    });

    $(document).delegate("#edit_product_btn", "click", function(e){
        let id = $('input[name="products_table_radio"]:checked').val();
        editProduct(id)
    });

    $(document).delegate("#edit-confirm-btn", "click", function(e){
        let id = $('#id').val();
        let title = $('#title').val();
        let description = $('#description').val();
        let price = $('#price').val();
        $.ajax({
            url: "/products/edit-entry",
            type:'GET',
            dataType: "json",
            data: {
                id: id,
                title: title,
                description: description,
                price: price,
            },
            success: function(data) {
                if (data['status'] === undefined) {
                    if (data['title'] !== undefined) {
                        $('#error-message-title').html(data['title'][0]).fadeIn(700);
                    } else {
                        $('#error-message-title').html('');
                    }
                    if (data['description'] !== undefined) {
                        $('#error-message-description').html(data['description'][0]).fadeIn(700);
                    } else {
                        $('#error-message-description').html('');
                    }
                    if (data['price'] !== undefined) {
                        $('#error-message-price').html(data['price'][0]).fadeIn(700);
                    } else {
                        $('#error-message-price').html('');
                    }
                } else if (data.status === 'success') {
                    $('#add_edit_table_modal').modal('hide');
                    $('.error-message').html('').hide();
                    let datatable = createTable();
                    datatable.on('draw', function () {
                        $('#tbl_radio_btn_' + id).prop('checked', true);
                    });
                }
            }
        });
    });

    $(document).delegate("#create_order_confirm-btn", "click", function(e){
        let title_orders = $('#title_orders').val();
        let description_orders = $('#description_orders').val();
        let product_id = $(this).data('product_id');
        $('.error-message').html('').hide();
        $.ajax({
            url: '/products/create-order',
            method: 'GET',
            dataType: 'json',
            data: {
                title_orders: title_orders,
                description_orders: description_orders,
                product_id: product_id,
            },
            success: function (data) {
                if (data['status'] === undefined) {
                    if (data['title_orders'] !== undefined) {
                        $('#error-message-title_orders').html(data['title_orders'][0]).fadeIn(700);
                    } else {
                        $('#error-message-title_orders').html('');
                    }
                    if (data['description_orders'] !== undefined) {
                        $('#error-message-description_orders').html(data['description_orders'][0]).fadeIn(700);
                    } else {
                        $('#error-message-description_orders').html('');
                    }
                } else if (data.status === 'success') {
                    $('#create_order_table_modal').modal('hide');
                    $('#title_orders').val('');
                    $('#description_orders').val('');
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).delegate(".delete_btn", "click", function(e){
        let id = $(this).data("id");
        $('#confirmationModal').modal('show');
        $('#delete_id').html(id);
        $(document).delegate("#confirmation-modal-delete-button", "click", function(e){
            $('#confirmationModal').modal('hide');
            $.ajax({
                url: '/products/delete-data',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function (data) {
                    if (data.status === 'success') {
                        $('#table-products').DataTable().row("#product_id_" + id).remove().draw();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    $(document).delegate("#table-products tr", "click", function(e){
        let id = $(this).data('id');
        $('#tbl_radio_btn_' + id).prop('checked', true);
        let radio_btn_state = 0;
        if (radio_btn_state === 0) {
            $('#edit_product_btn').removeClass("edit-btn-disabled");
        }
        radio_btn_state = 1;
    });

    $(document).delegate("#table-products tr", "dblclick", function(e){
        let id = $(this).data('id');
        editProduct(id);
    });

    function editProduct(id) {
        $('#edit-confirm-btn').show();
        $('#add-confirm-btn').hide();
        $('.error-message').html('').hide();
        $.ajax({
            url: '/products/data-to-update-entry',
            method: 'GET',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (data) {
                $('#id').val(id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#add_edit_table_modal').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function createTable() {
        $('#table-products').DataTable().clear().destroy();
        let datatable = $('#table-products').DataTable({
            "lengthChange": false,
            "searching": true,
            "bInfo" : false,
            "order": [[1, "asc"]],
            "pageLength": 10,
            "language": {
                "searchPlaceholder": "#id #title #description",
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).attr('id', 'product_id_' + data.id);
                $(row).attr('data-id', data.id);
            },
            "ajax": {
                "url": '/products/table-data',
                "data": {}
            },
            "columns": [
                {"data": "radio_btn", "title": "", "orderable": false, "searchable": false, "className": "text-center text-wrap radio_btn", "width": "5%"},
                {"data": "id", "title": "id", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "5%"},
                {"data": "title","title": "Title", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "10%"},
                {"data": "description","title": "Description", "orderable": true, "searchable": true, "className": "text-center text-wrap", "width": "20%"},
                {"data": "price", "title": "price", "orderable": true, "searchable": false, "className": "text-center text-wrap", "width": "15%"},
                {"data": "create_order", "title": "", "orderable": false, "searchable": false, "className": "text-center text-wrap", "width": "15%"},
                {"data": "delete", "title": "", "orderable": false, "searchable": false, "className": "text-center text-wrap", "width": "10%"},
            ],
        });

        return datatable;
    }


</script>
@endsection




