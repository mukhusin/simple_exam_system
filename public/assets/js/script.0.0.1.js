$(document).ready(function (e) {
    $("#add-item-form").ajaxForm({
        success: function (data) {
            if (data.error) {
                toastr.error(data.error);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#add-item-form")[0].reset();
                location.reload();
            }
        },
    });
});

//  Unit Ajax
$(document).ready(function (e) {
    $("#create_item_form").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#create_item_form")[0].reset();
                location.reload();
            }
        },
    });
});

//  Shelf Ajax
$(document).ready(function (e) {
    $("#create_shelf_form").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#create_shelf_form")[0].reset();
                location.reload();
            }
        },
    });
});

$(document).ready(function (e) {
    $("#update_unit_form").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#update_unit_form")[0].reset();
                //  location.reload();
                window.location.href = "/item_unit";
            }
        },
    });
});

$(document).ready(function (e) {
    $("#update_shelf_form").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#update_shelf_form")[0].reset();
                //  location.reload();
                window.location.href = "/setting";
            }
        },
    });
});

//EDIT MEDICINE AJAX MESSAGE
$(document).ready(function (e) {
    $("#update_item_form").ajaxForm({
        success: function (data) {
            if (data.error) {
                toastr.error(data.error);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#update_item_form")[0].reset();
                //  location.reload();
                window.location.href = "/items";
            }
        },
    });
});

//  Delete Unit
function deleteUnit(cat_id) {
    //  alert(cat_id);
    $("#del_dataId").val(cat_id);
    $("#deleteCat").modal("show");
}

$(document).ready(function (e) {
    $("#deleteUnit").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                $("#deleteUnit")[0].reset();
                //  location.reload();
                window.location.href = "/setting";
            }
        },
    });
});
//  End of Delete Unit

//  Delete Shelf
function deleteShelf(shelf_id) {
    //  alert(cat_id);
    $("#delete_dataId").val(shelf_id);
    $("#deleteShelf").modal("show");
}

$(document).ready(function (e) {
    $("#deleteShelf").ajaxForm({
        success: function (data) {
            if (data.errors) {
                toastr.error(data.errors);
            }
            if (data.success) {
                toastr.success(data.success);
                // $('#deleteShelf')[0].reset();
                //  location.reload();
                window.location.href = "/setting";
            }
        },
    });
});

function confirmDialog(dataId,mode,message) {
    $('#confirm_dataId').val(dataId);
    $('#confirm_mode').val(mode);
    $('#confirm_message').html(message);
    $('#confirmation_dialog').modal('show');
}

function generatePdfModal(dataId,mode,message) {
    $('#doc_dataId').val(dataId);
    $('#docType').val(mode);
    $('#doc_message').html(message);
    $('#generate_pdf_doc_modal').modal('show');
}

function add_to_cart_model(stock_id,dataId,item_unit,item_name) {
    $('#add_to_cat_id').val(dataId);
    $('#item_unit_id').val(item_unit);
    $('#stock_id_sale').val(stock_id);
    $('#item_name_id').html(item_name);
    $('#add_to_cart_model').modal('show');
}



$(document).ready(function (e) {
    $("#changepassword-form").ajaxForm({
       beforeSend: function () {
           $(".waiting-saving").html(
               ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
           );
       },

       success: function (data) {
           if (data.error) {
               $(".waiting-saving").html("");
               toastr.error(data.error);
               $(".message").html(
                   '<p class="text-danger">' + data.error + "</p>"
               );
           }
           if (data.success) {
               $("#changepassword-form")[0].reset();
               toastr.success(data.success);
               $(".waiting-saving").html("");
           }
       },
   });
});
