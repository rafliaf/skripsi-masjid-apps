
let table = new DataTable('#myTable', {
    responsive: true
});

// onAddClicked
function onAddClicked(){
    window.location.href = '/dashboard/tambah_user';
}


// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function onEditClicked(element) {
    var row = $(element).closest('tr');
    var userId = row.data('id');
    var userName = row.data('nama');
    var userEmail = row.data('email');
    var userRole = row.data('role');

    console.log("User ID: ", userId);  // Debugging
    console.log("User Name: ", userName);  // Debugging
    console.log("User Email: ", userEmail);  // Debugging
    console.log("User Role: ", userRole);  // Debugging

    // Populate modal fields
    $('#inputNama').val(userName);
    $('#inputEmail').val(userEmail);
    $('#inputGroupSelect01').val(userRole);
    $('#hiddenUserId').val(userId);

    // Show the edit modal
    $('#modalEdit').modal('show');
}


function onDeleteClicked(element) {
    var row = $(element).closest('tr');
    var userId = row.data('id');

    // Update the form action to include the user ID in the URL
    var form = $('#deleteUserForm');
    form.attr('action', '/dashboard/user/' + userId + '/delete');

    // Populate hidden input with user ID for deletion if needed
    $('#hiddenDeleteUserId').val(userId);

    // Show the delete modal
    $('#modalDelete').modal('show');
}


// Close edit modal
function onCloseModalEdit(){
    $('#modalEdit').modal('hide');
}


// Close delete modal
function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}

// location back
function onClickLocationBack(){
    window.location.href = '/data_user';
}