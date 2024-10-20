
let table = new DataTable('#myTable', {
    responsive: true
});

// tambah jenis keahlian
function onAddJenisKeahlian(){
    window.location.href = window.location.href + '/create_jenis_keahlian';
}

// tambah data keahlian
function onAddKeahlian(){
    window.location.href = window.location.href + '/create';
}

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function onDeleteClicked(id) {
    var form = document.getElementById('deleteForm');
    form.action = '/dashboard/data_keahlian/' + id; // Set the form action to the DELETE route with the correct ID
    $('#modalDelete').modal('show'); // Show the modal
}


function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}


function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}

// location back
function onClickLocationBack(){
    window.history.back();
}

// add family card
function onEditClicked(){
    window.location.href = window.location.href + '/edit';
}

function onClickLocationBack(){
    window.history.back()
  }

function onClickNext(){
    window.location.href =  '/dashboard/data_keahlian/create';
  }

