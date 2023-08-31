<!DOCTYPE html>
<html>

<head>
  <title>Form Generator</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">

</head>

<body ">
    <div class=" container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <div class="container">
            <h2 style="text-align:center;">Create Your Form</h2>
            <?php
            $user_id = $this->session->userdata('user_id');
            if ($user_id !== null) {
              echo "User ID: " . $user_id;
            } else {
              echo "User ID not set.";
            }
            ?>
            <form action="index" method="post" id="form-generator-form">
              <div class="mb-4">
                <label for="form_title" class="form-label">Form Title:</label>
                <input type="text" class="form-control" name="form_title" required>
              </div>

              <div class="mb-4">
                <label for="form_description" class="form-label">Form Description:</label>
                <textarea class="form-control" name="form_description"></textarea>
              </div>

              <h3>Form Fields</h3>

              <div class="form-group mt-4" id="form-fields-container">
                <!-- Fields will be added here -->
              </div>

              <button type="button" class="btn btn-primary btn-lg me-4 mt-3 mb-4" id="add-field-button">Add Field</button>

              <button type="submit" class="btn btn-success btn-lg mt-3 mb-4">Save Form</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addFieldButton = document.getElementById('add-field-button');
      const formFieldsContainer = document.getElementById('form-fields-container');
      let j = 0; // Declare the variable j

      addFieldButton.addEventListener('click', function() {
        addFormInputField(formFieldsContainer, j); // Pass j to the function
        j++; // Increment j for the next field
      });

      // Initial field
      addFormInputField(formFieldsContainer, j); // Pass j to the function
      j++; // Increment j for the next field
    });

    function addFormInputField(container, j) {
      const fieldDiv = document.createElement('div');
      fieldDiv.className = 'mb-4';
      let fieldIndex = 0;
      fieldDiv.setAttribute('data-field-index', j)
      fieldDiv.innerHTML = `
        <label for="field_label" class="form-label">Field Label:</label>
        <input type="text" class="form-control mb-4" name="field_label[]" required>

        <label for="field_type" class="form-label mt-2">Input Type:</label>
        <select class="form-select mb-4" name="field_type[]">
            <option  value="Textbox">Textbox</option>
            <option value="Dropdown">Dropdown</option>
            <option value="Date">Date</option>
            <option value="Email">Email</option>
            <option value="File">File</option>
            <option value="Textarea">Textarea</option>
            <option value="Radio">Radio-Buttons</option>
            <option value="Checkbox">Checkbox</option>
        </select>

        <div class="input-specific mt-2">
        <!-- Input field will be added here based on selection -->
        </div>

        <div class="size-length mt-2">
            <label class="form-label mt-4">Size/Length:</label>
            <input type="text" class="form-control" name="size_length[]" placeholder="Enter Size/Length">
        </div>

        <div class="options mt-2">
            <label class="form-label">Options:</label>
            <div class="option-fields">
                <div class="option-field">
                    <div class="row">
                        <div class="col-md-5">
                        <input type="text" class="form-control" name="option_value[${j}][]" placeholder="Option Value">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-primary mt-2 add-option">Add Option</button>
         </div>

        <div class="container mt-4 mb-4">
            <label for="field_required" class="form-check-label">Required: </label>
            <input type="checkbox" class="form-check-input" name="field_required[]">
        </div>

        <div class="mt-2">
            <button type="button" class="btn btn-danger btn-md remove-field mt-3">Remove Field</button>
        </div>
    `;

      container.appendChild(fieldDiv);

      const fieldTypeSelect = fieldDiv.querySelector('select[name="field_type[]"]');
      const inputSpecificDiv = fieldDiv.querySelector('.input-specific');
      const sizeLengthDiv = fieldDiv.querySelector('.size-length');
      const optionsDiv = fieldDiv.querySelector('.options');

      fieldTypeSelect.addEventListener('change', function() {
        j++;
        toggleInputSpecific(inputSpecificDiv, this.value);
        toggleSizeLength(sizeLengthDiv, this.value);
        toggleOptions(optionsDiv, this.value);
      });

      fieldDiv.querySelector('.add-option').addEventListener('click', function() {
        addOptionField(optionsDiv);
      });

      fieldDiv.querySelector('.remove-option').addEventListener('click', function() {
        removeOptionField(this);
      });

      fieldDiv.querySelector('.remove-field').addEventListener('click', function() {
        removeField(this);
      });

      toggleInputSpecific(inputSpecificDiv, fieldTypeSelect.value);
      toggleSizeLength(sizeLengthDiv, fieldTypeSelect.value);
      toggleOptions(optionsDiv, fieldTypeSelect.value);
    }

    function toggleInputSpecific(inputSpecificDiv, fieldType) {
      inputSpecificDiv.innerHTML = ''; // Clear any existing input fields

      if (fieldType === 'Date') {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
            <input type="date" class="form-control" name="input[]" placeholder="Enter Date">
        `;
      } else if (fieldType === 'Textarea') {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
            <textarea class="form-control" name="input[]" placeholder="Enter Text"></textarea>
        `;
      } else if (fieldType === 'File') {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
            <input type="file" class="form-control" name="input[]" placeholder="Choose File">
        `;
      } else if (fieldType === 'Textbox') {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
            <input type="text" class="form-control" name="input[]" placeholder="Enter Input">
        `;
      } else if (fieldType === 'Email') {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
            <input type="email" class="form-control" name="input[]" placeholder="Enter Input">
        `;
      } else {
        inputSpecificDiv.innerHTML = `
            <label class="form-label">Input:</label>
        `;
      }
    }

    function toggleSizeLength(sizeLengthDiv, fieldType) {
      if (fieldType === 'Textbox') {
        sizeLengthDiv.style.display = 'block';
      } else {
        sizeLengthDiv.style.display = 'none';
      }
    }

    function toggleOptions(optionsDiv, fieldType) {
      if (['Dropdown', 'Checkbox', 'Radio'].includes(fieldType)) {
        optionsDiv.style.display = 'block';
      } else {
        optionsDiv.style.display = 'none';
      }
    }

    function addOptionField(optionsDiv) {
      const optionField = document.createElement('div');
      optionField.className = 'option-field';
      const fieldIndex = optionsDiv.closest('.mb-4').getAttribute('data-field-index');

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

      optionsDiv.querySelector('.option-fields').appendChild(optionField);

      optionField.querySelector('.remove-option').addEventListener('click', function() {
        removeOptionField(this);
      });
    }

    function removeOptionField(button) {
      button.closest('.option-field').remove();
    }

    function removeField(button) {
      button.closest('.mb-4').remove();
    }
  </script>
</body>

</html>