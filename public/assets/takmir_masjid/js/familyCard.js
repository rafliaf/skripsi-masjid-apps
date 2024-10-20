
let table = new DataTable('#myTable', {
    responsive: true
});

// onAddClicked
function onAddClicked(){
    window.location.href = window.location.href + '/create';
}
// function onAddClicked(){
//     window.location.href = '/tambah_kartu_keluarga';
// }

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// modal
function onDeleteClicked() {
    $('#modalDelete').modal('show');
}

function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}

// location back
function onClickLocationBack(){
    window.history.back();
}

// edit family card
function onEditClicked(id) {
    window.location.href = `/dashboard/data_kk/${id}/edit`;
}

// delete click
function onDeleteClicked(id) {
    // Set the user ID in the hidden input field of the modal form
    document.getElementById('hiddenDeleteUserId').value = id;

    // Update the form action dynamically to include the user ID in the URL
    let form = document.getElementById('deleteUserForm');
    form.action = `/dashboard/data_kk/${id}`;

    // Show the modal
    $('#modalDelete').modal('show');
}

function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}


