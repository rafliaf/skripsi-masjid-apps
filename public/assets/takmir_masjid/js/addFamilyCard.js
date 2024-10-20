
let table = new DataTable('#myTable', {
    responsive: true
});

// onAddClicked
function onAddClicked(){
    window.location.href = '/tambah_kartu_keluarga';
}

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// modal
function onEditClicked() {
    $('#modalEdit').modal('show');
}

function onDeleteClicked() {
    $('#modalDelete').modal('show');
}

function onCloseModalEdit(){
    $('#modalEdit').modal('hide');
}

function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}

// location back
function onClickLocationBack(){
    window.location.href = '/dashboard/data_kk';
}

// function hide sertifikat
function toggleCertificateDescription() {
    var selectBox = document.getElementById("sertifikat");
    var certificateDescription = document.getElementById("deskripsiSertifikat");

    if (selectBox.value === "ya") {
        certificateDescription.style.display = "flex"; // Use flex to keep the row layout
    } else {
        certificateDescription.style.display = "none";
    }
}