let table = new DataTable('#myTable', {
  responsive: true
});

$(document).ready(function () {
  let inputCount = $('#inputContainer .input-group').length || 1; // Start with the number of existing inputs or 1.

  // Function to add a new input field
  window.onClickAdd = function () {
      inputCount++;
      const newInputGroup = `
      <div class="input-group row justify-content-center mt-4" id="inputGroup-${inputCount}">
          <label for="inputNama-${inputCount}" class="col-md-3 col-form-label">Jenis keahlian ke-${inputCount}</label>
          <div class="col-sm-6">
              <input type="text" class="form-control margin-top-20" name="jenis_keahlian[]" id="inputNama-${inputCount}" placeholder="Jenis keahlian" required oninput="checkIfEmpty()">
          </div>
          <div style="margin-left: 10px; display: flex; align-items: flex-end; gap: 5px;">
              <button type="button" class="btn btn-success btn-add" onclick="onClickAdd()">
                  <span class="fa fa-plus"></span>
              </button>
              <button type="button" class="btn btn-danger btn-delete" onclick="onClickRemove(this)">
                  <span class="fa fa-minus"></span>
              </button>
          </div>
      </div>`;
  
      $('#inputContainer').append(newInputGroup);
      updateButtons();
      checkIfEmpty(); // Check inputs after adding a new one
  };

  // Function to remove an input field
  window.onClickRemove = function (button) {
      $(button).closest('.input-group').remove();
      inputCount = $('#inputContainer .input-group').length; // Recalculate inputCount based on remaining inputs
      updateLabels();
      updateButtons();
      checkIfEmpty(); // Check inputs after removing one
  };

  // Function to check if all input fields are filled
  window.checkIfEmpty = function () {
      let allFilled = true;

      $('input[name="jenis_keahlian[]"]').each(function() {
          if ($(this).val().trim() === '') {
              allFilled = false;
              return false; // Break out of the loop if an empty field is found
          }
      });

      $('#addButton').prop('disabled', !allFilled); // Enable the button if all inputs are filled
  };

  // Function to update labels after adding/removing inputs
  function updateLabels() {
      $('#inputContainer .input-group').each(function (index) {
          const currentIndex = index + 1;
          $(this).attr('id', `inputGroup-${currentIndex}`);
          $(this).find('label').attr('for', `inputNama-${currentIndex}`).text(`Jenis keahlian ke-${currentIndex}`);
          $(this).find('input').attr('id', `inputNama-${currentIndex}`);
      });
  }

  // Function to update the visibility of add/remove buttons
  function updateButtons() {
      if (inputCount > 1) {
          $('.btn-delete').show(); // Show delete buttons if more than one input
      } else {
          $('.btn-delete').hide(); // Hide delete buttons if only one input
      }
  }

  // Initial call to update buttons and check if inputs are empty
  updateButtons();
  checkIfEmpty();

  // Trigger input validation on all existing input fields when the page is ready
  $('input[name="jenis_keahlian[]"]').on('input', checkIfEmpty);
});

// Function for navigating back to the previous page
function onClickLocationBack(){
    window.location.href = '/dashboard/data_keahlian'
}

