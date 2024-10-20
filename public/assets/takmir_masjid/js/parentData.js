
let table = new DataTable('#myTable', {
    responsive: true
});

// onAddClicked
function onAddClicked(){
    window.location.href = window.location.href + '/create';
}

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

// add family card
function onEditClicked(id) {
    window.location.href = `/dashboard/data_induk/edit/${id}`;
}

// DELETE
// Function to open the delete modal and set the form action
function onDeleteClicked(id) {
    var url = `/dashboard/data_induk/${id}`;  // Define the delete URL with the ID
    $('#deleteForm').attr('action', url);  // Set the action URL in the form
    $('#modalDelete').modal('show');  // Show the modal
}

// Function to close the delete modal
function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}
