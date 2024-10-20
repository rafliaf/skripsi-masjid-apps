// modal
function onClickNext() {
    // Hide the current modal using jQuery
    $('#exampleModal').modal('hide');

    // Delay to ensure the current modal hides before showing the next one
    $('#exampleModal').on('hidden.bs.modal', function () {
        // Show the next modal
        $('#nextModal').modal('show');
    });
}

function onCloseModal(){
    $('#nextModal').modal('hide').on('hidden.bs.modal', function () {
        window.location.href = '/index_admin_masjid';
    });
}


// function show password
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
