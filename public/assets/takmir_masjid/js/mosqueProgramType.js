let table = new DataTable('#myTable', {
    responsive: true
});

$(document).ready(function () {
  let inputCount = 1;

  // Function to add a new input field
  window.onClickAdd = function () {
      inputCount++;
      const newInputGroup = `
          <div class="input-group row justify-content-center mt-4" id="inputGroup-${inputCount}">
              <label for="inputNama-${inputCount}" class="col-md-3 col-form-label">Jenis program ke-${inputCount}</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control margin-top-20" name="jenis_program[]" id="inputNama-${inputCount}" placeholder="Jenis program" required>
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
  };

  // Function to remove an input field
  window.onClickRemove = function (button) {
      $(button).closest('.input-group').remove();
      inputCount--;
      updateLabels();
      updateButtons();
  };

  // Function to update the visibility of add/remove buttons
  function updateButtons() {
      if (inputCount > 1) {
          // Show remove button for all except the first input
          $('.btn-delete').show();
      } else {
          // Hide remove button if there's only one input field
          $('.btn-delete').hide();
      }
  }

  // Function to update the labels after adding/removing input
  function updateLabels() {
      $('#inputContainer .input-group').each(function (index) {
          const currentIndex = index + 1;
          $(this).attr('id', `inputGroup-${currentIndex}`);
          $(this).find('label').attr('for', `inputNama-${currentIndex}`).text(`Jenis program ke-${currentIndex}`);
          $(this).find('input').attr('id', `inputNama-${currentIndex}`);
      });
  }

  // Initial call to update buttons
  updateButtons();
});


  function onClickLocationBack(){
    window.location.href = '/dashboard/program_takmir';
  }