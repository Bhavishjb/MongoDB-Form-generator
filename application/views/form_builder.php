<!DOCTYPE html>
<html>

<head>
    <title>Form Generator Template</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <h2 style="text-align:center;">Create Your Form</h2>
                            <form action="process_form.php" method="post">
                                <div class="mb-3">
                                    <label for="form_title" class="form-label">Form Title:</label>
                                    <input type="text" class="form-control" name="form_title" required>
                                </div>

                                <div class="mb-4">
                                    <label for="form_description" class="form-label">Form Description:</label>
                                    <textarea class="form-control" name="form_description"></textarea>
                                </div>

                                <h3>Form Fields</h3>
                                <div id="form_fields">
                                    <div class="form-field">
                                        <div class=" mt-4 mb-4">
                                            <label for="field_label" class="form-label">Field Label:</label>
                                            <input type="text" class="form-control" name="field_label" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label>Input Type:</label>
                                            <select id="input-type-select" class="form-control" name="field_type">
                                                <option value="Textbox">Textbox</option>
                                                <option value="Dropdown">Dropdown</option>
                                                <option value="Date">Date</option>
                                                <option value="Email">Email</option>
                                                <option value="File">File</option>
                                                <option value="Textarea">Textarea</option>
                                                <option value="Radio">Radio-Buttons</option>
                                                <option value="Checkbox">Checkbox</option>
                                            </select>
                                        </div>

                                        <div class="dynamic-input-group mb-4" id="dynamic-input-group" style="display: none;">
                                            <label>Additional Input:</label>
                                            <div class="dynamic-input-container"></div>
                                        </div>

                                        <div class="form-group mb-4" id="size-length-group">
                                            <label>Size/Length:</label>
                                            <input type="text" class="form-control" name="size_length" placeholder="Enter Size/Length">
                                        </div>

                                        <div class="form-group mb-4" id="options-group">
                                            <label>Options</label>
                                            <div class="option-fields">
                                                <div class="option-field">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="option_value[]" placeholder="Option Value">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-sm btn-secondary add-option">Add Option</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="field_required" class="form-check-label">Required:</label>
                                            <input type="checkbox" class="form-check-input" name="field_required">
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add_field" class="btn btn-primary mb-3">Add More</button><br>

                                <button type="submit" class="btn btn-success mb-3">Save Form</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            handleSizeVisibility();
            handleOptionsVisibility();

            document.querySelector('.add-option').addEventListener('click', addOptionField);
            document.getElementById('input-type-select').addEventListener('change', function() {
                handleSizeVisibility();
                handleOptionsVisibility();
            });
        });

        function handleSizeVisibility() {
            var sizeLengthGroup = document.getElementById('size-length-group');
            var inputTypeSelect = document.getElementById('input-type-select');

            if (inputTypeSelect.value === 'Textbox') {
                sizeLengthGroup.style.display = 'block';
            } else {
                sizeLengthGroup.style.display = 'none';
            }
        }

        function handleOptionsVisibility() {
            var optionsGroup = document.getElementById('options-group');
            var inputTypeSelect = document.getElementById('input-type-select');

            if (inputTypeSelect.value === 'Dropdown' || inputTypeSelect.value === 'Checkbox' || inputTypeSelect.value === 'Radio') {
                optionsGroup.style.display = 'block';
            } else {
                optionsGroup.style.display = 'none';
            }
        }

        function addOptionField() {
            var optionField = document.querySelector('.option-field').cloneNode(true);
            var removeButton = optionField.querySelector('.remove-option');

            removeButton.addEventListener('click', function() {
                optionField.remove();
            });

            optionField.querySelector('input[name="option_value[]"]').value = '';

            document.querySelector('.option-fields').appendChild(optionField);
        }
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('input-type-select').addEventListener('change', function() {
                handleSizeVisibility();
                handleOptionsVisibility();
                handleDynamicInput();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('input-type-select').addEventListener('change', function() {
                handleSizeVisibility();
                handleOptionsVisibility();
                handleDynamicInput();
            });
        });


        function handleDynamicInput() {
            var dynamicInputGroup = document.getElementById('dynamic-input-group');
            var inputTypeSelect = document.getElementById('input-type-select');
            var dynamicInputContainer = document.querySelector('.dynamic-input-container');


            while (dynamicInputContainer.firstChild) {
                dynamicInputContainer.removeChild(dynamicInputContainer.firstChild);
            }


            if (inputTypeSelect.value === 'Date') {
                dynamicInputContainer.innerHTML = '<input type="date" class="form-control" name="dynamic_input">';
            } else if (inputTypeSelect.value === 'Textbox') {
                dynamicInputContainer.innerHTML = '<input type="text" class="form-control" name="dynamic_input">';
            } else if (inputTypeSelect.value === 'Email') {
                dynamicInputContainer.innerHTML = '<input type="email" class="form-control" name="dynamic_input">';
            } else if (inputTypeSelect.value === 'File') {
                dynamicInputContainer.innerHTML = '<input type="file" class="form-control" name="dynamic_input">';
            } else if (inputTypeSelect.value === 'Textarea') {
                dynamicInputContainer.innerHTML = '<textarea class="form-control" name="dynamic_input"></textarea>';
            }

            if (inputTypeSelect.value === 'Date' || inputTypeSelect.value === 'Textbox' ||
                inputTypeSelect.value === 'Email' || inputTypeSelect.value === 'File' ||
                inputTypeSelect.value === 'Textarea' || inputTypeSelect.value === 'Radio') {
                dynamicInputGroup.style.display = 'block';
            } else {
                dynamicInputGroup.style.display = 'none';
            }
        }
    </script>
</body>

</html>