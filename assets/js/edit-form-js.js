document.addEventListener('DOMContentLoaded', function() {
    const addOptionButtons = document.querySelectorAll('.add-option');
    const removeOptionButtons = document.querySelectorAll('.remove-option');

    addOptionButtons.forEach(button => {
      button.addEventListener('click', function() {
        addOptionField(this);
      });
    });

    removeOptionButtons.forEach(button => {
      button.addEventListener('click', function() {
        removeOptionField(this);
      });
    });

    function addOptionField(button) {
      const optionField = document.createElement('div');
      optionField.className = 'option-field';
      const fieldIndex = button.closest('.mb-4').getAttribute('data-field-index');

      optionField.innerHTML = `
                  <div class="row">
                      <div class="col-md-5">
                          <input type="text" class="form-control" name="option_value[${fieldIndex}][]" placeholder="Option Value">
                      </div>
                      <div class="col-md-2">
                          <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                      </div>
                  </div>
              `;

      button.closest('.mb-4').querySelector('.option-fields').appendChild(optionField);

      optionField.querySelector('.remove-option').addEventListener('click', function() {
        removeOptionField(this);
      });
    }

    function removeOptionField(button) {
      button.closest('.option-field').remove();
    }
  });
  $(document).ready(function() {
  $('select[name="field_type[]"]').on('change', function() {
      var selectedFieldType = $(this).val();
      var optionFields = $('.option-fields');
      var addOptionButton = $('.add-option');

      if (selectedFieldType === 'Dropdown' || selectedFieldType === 'Checkbox' || selectedFieldType === 'Radio') {
          optionFields.show();
          addOptionButton.show();
      } else {
          optionFields.hide();
          addOptionButton.hide();
      }
  });
});