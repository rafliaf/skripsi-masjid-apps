// location back
function onClickLocationBack(){
    window.location.href = '/dashboard/data_keahlian';
}
// function to toggle certificate description visibility
function toggleCertificateDescription() {
    var selectBox = document.getElementById("sertifikat");
    var certificateDescription = document.getElementById("deskripsiSertifikat");

    if (selectBox.value === "ya") {
        certificateDescription.style.display = "flex"; // Use flex to maintain row layout
    } else {
        certificateDescription.style.display = "none";
    }
}
