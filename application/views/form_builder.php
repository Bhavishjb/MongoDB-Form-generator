<!DOCTYPE html>
<html>

<head>
    <title>Form Generator</title>
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
                            <form action="index" method="post">
                            
                                <div class="mb-3">
                                    <label for="form_title" class="form-label">Form Title:</label>
                                    <input type="text" class="form-control" name="form_title" required>
                                </div>

                                <div class="mb-4">
                                    <label for="form_description" class="form-label">Form Description:</label>
                                    <textarea class="form-control" name="form_description"></textarea>
                                </div>

                                <h3>Form Fields</h3>
                                
                                    <div class="form-group">
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

                                        <div class="form-group mb-4" id="dynamic-input-group" style="display: none;">
                                            <label>Input:</label>
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
                                    <br><br>
                                    <button type="button" id="add_more_option" class="btn btn-primary mb-3">Add More Option</button><br>

                                <button type="submit" class="btn btn-success mb-3">Save Form</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add_more_option');
        const inputTypeSelect = document.getElementById('input-type-select');

        addButton.addEventListener('click', addMoreOption);
        inputTypeSelect.addEventListener('change', function() {
            handleSizeVisibility();
            handleOptionsVisibility();
            handleDynamicInput();
        });

        function handleSizeVisibility() {
            const sizeLengthGroup = document.getElementById('size-length-group');
            sizeLengthGroup.style.display = inputTypeSelect.value === 'Textbox' ? 'block' : 'none';
        }

        function handleOptionsVisibility() {
            const optionsGroup = document.getElementById('options-group');
            const showOptions = ['Dropdown', 'Checkbox', 'Radio'].includes(inputTypeSelect.value);
            optionsGroup.style.display = showOptions ? 'block' : 'none';
        }

        function handleDynamicInput() {
            const dynamicInputGroup = document.getElementById('dynamic-input-group');
            const dynamicInputContainer = document.querySelector('.dynamic-input-container');

            while (dynamicInputContainer.firstChild) {
                dynamicInputContainer.removeChild(dynamicInputContainer.firstChild);
            }

            let dynamicInputHTML = '';
            if (inputTypeSelect.value === 'Date' || inputTypeSelect.value === 'Textbox' ||
                inputTypeSelect.value === 'Email' || inputTypeSelect.value === 'File' ||
                inputTypeSelect.value === 'Textarea' || inputTypeSelect.value === 'Radio') {
                dynamicInputHTML = getInputHTMLByType(inputTypeSelect.value);
                dynamicInputGroup.style.display = 'block';
            } else {
                dynamicInputGroup.style.display = 'none';
            }

            dynamicInputContainer.innerHTML = dynamicInputHTML;
        }

        function getInputHTMLByType(inputType) {
            if (inputType === 'Date') {
                return '<input type="date" class="form-control" name="dynamic_input">';
            } else if (inputType === 'Textbox') {
                return '<input type="text" class="form-control" name="dynamic_input">';
            } else if (inputType === 'Email') {
                return '<input type="email" class="form-control" name="dynamic_input">';
            } else if (inputType === 'File') {
                return '<input type="file" class="form-control" name="dynamic_input">';
            } else if (inputType === 'Textarea') {
                return '<textarea class="form-control" name="dynamic_input"></textarea>';
            }
        }

        function addOptionField() {
            const optionField = document.querySelector('.option-field').cloneNode(true);
            const removeButton = optionField.querySelector('.remove-option');

            removeButton.addEventListener('click', function() {
                optionField.remove();
            });

            optionField.querySelector('input[name="option_value[]"]').value = '';

            document.querySelector('.option-fields').appendChild(optionField);
        }

        function applyFormEventListeners(optionField) {
            const removeOptionButton = optionField.querySelector('.remove-option');
            removeOptionButton.addEventListener('click', function() {
                this.closest('.option-field').remove();
            });
        }

        function addMoreOption() {
            const optionDiv = document.querySelector('.form-group').cloneNode(true);
            optionDiv.style.display = 'block'; // Display the cloned form group

            // Clear input values, selected options, dynamic input, and option fields
            optionDiv.querySelectorAll('input').forEach(input => input.value = '');
            optionDiv.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            optionDiv.querySelector('.dynamic-input-container').innerHTML = '';
            optionDiv.querySelectorAll('.option-field').forEach((optionField, index) => {
                if (index !== 0) {
                    optionField.remove();
                }
            });

            optionDiv.querySelector('.remove-option').remove();

            const addButton = document.getElementById('add_more_option');
            const br1 = document.createElement('br');
            const br2 = document.createElement('br');
            addButton.parentNode.insertBefore(optionDiv, addButton);
            addButton.parentNode.insertBefore(br1, addButton);
            addButton.parentNode.insertBefore(br2, addButton);

            optionDiv.scrollIntoView({ behavior: 'smooth' });

            applyFormEventListeners(optionDiv); // Apply event listeners to the new option fields
        }

        // Initial setup
        handleSizeVisibility();
        handleOptionsVisibility();
        applyFormEventListeners(document.querySelector('.form-group'));
    });
</script>

</body>

</html>