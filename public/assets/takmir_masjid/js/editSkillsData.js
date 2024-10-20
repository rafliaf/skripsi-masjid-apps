// location back
function onClickLocationBack(){
    window.history.back();
}

// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    toggleCertificateDescription(); // Initialize on page load
});

// Function to toggle certificate description visibility
function toggleCertificateDescription() {
    var selectBox = document.getElementById("inputSertifikat");
    var certificateDescription = document.getElementById("certificateDescription");

    if (selectBox.value === "ya") {
        certificateDescription.style.display = "flex";
    } else {
        certificateDescription.style.display = "none";
    }
}

