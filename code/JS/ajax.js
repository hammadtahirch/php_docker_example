$(document).ready(function() {
    showAllCustomer();
    //View Record
    function showAllCustomer() {
        $.ajax({
            url: "method.php",
            type: "POST",
            data: { action: "view" },
            success: function(response) {
                $("#tableData").html(response);
                $("table").DataTable({
                    order: [0, 'DESC']
                });
            }
        });
    }

    //insert ajax request data
    $("#submit").click(function(e) {
        if ($("#formData")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "method.php",
                type: "POST",
                data: $("#formData").serialize() + "&action=insert",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Customer added successfully',
                    });
                    $("#addModal").modal('hide');
                    $("#formData")[0].reset();
                    showAllCustomer();
                }
            });
        }
    });

    //Edit Record
    $("body").on("click", ".editBtn", function(e) {
        e.preventDefault();
        var editId = $(this).attr('id');
        $.ajax({
            url: "method.php",
            type: "POST",
            data: { editId: editId },
            success: function(response) {
                var data = JSON.parse(response);
                $("#edit-form-id").val(data.id);
                $("#name").val(data.name);
                $("#address").val(data.address);
                $("#city").val(data.city);
                $("#country").val(data.country);
            }
        });
    });

    //update 
    $("#update").click(function(e) {
        if ($("#EditformData")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "method.php",
                type: "POST",
                data: $("#EditformData").serialize() + "&action=update",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Customer updated successfully',
                    });
                    $("#editModal").modal('hide');
                    $("#EditformData")[0].reset();
                    showAllCustomer();
                }
            });
        }
    });

    //Delete Record
    $("body").on("click", ".deleteBtn", function(e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var deleteBtn = $(this).attr('id');
        if (confirm('Are you sure want to delete this Record')) {
            $.ajax({
                url: "method.php",
                type: "POST",
                data: { deleteBtn: deleteBtn },
                success: function(response) {
                    tr.css('background-color', '#ff6565');
                    Swal.fire({
                        icon: 'success',
                        title: 'Customer delete successfully',
                    });
                    showAllCustomer();
                }
            });
        }
    });
});