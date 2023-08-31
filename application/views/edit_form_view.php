<!DOCTYPE html>
<html>
<head>
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Form Elements</h2>
        <?php echo form_open('FormController/update_form/'.$form_data->_id); ?>
        <div class="form-group">
                <label for="form_title">Form Title</label>
                <input type="text" class="form-control" id="form_title" name="form_title" value="<?php echo $form_data->form_title; ?>">
            </div>
            <div class="form-group">
                <label for="form_description">Form Description</label>
                <textarea class="form-control" id="form_description" name="form_description"><?php echo $form_data->form_description; ?></textarea>
            </div>

            <?php foreach ($form_data->fields as $index => $field): ?>
                <div class="mb-4" data-field-index="<?php echo $index; ?>">
                    <label for="field_label_<?php echo $index; ?>" class="form-label">Field Label:</label>
                    <input type="text" class="form-control" name="field_label[]" value="<?php echo $field->field_label; ?>" required>

                    <label for="field_type_<?php echo $index; ?>" class="form-label">Field Type:</label>
                    <select class="form-select" name="field_type[]">
                        <option value="Text" <?php echo ($field->field_type === 'Text') ? 'selected' : ''; ?>>Textbox</option>
                        <option value="Dropdown" <?php echo ($field->field_type === 'Dropdown') ? 'selected' : ''; ?>>Dropdown</option>
                        <option value="Date" <?php echo ($field->field_type === 'Date') ? 'selected' : ''; ?>>Date</option>
                        <option value="Email" <?php echo ($field->field_type === 'Email') ? 'selected' : ''; ?>>Email</option>
                        <option value="File" <?php echo ($field->field_type === 'File') ? 'selected' : ''; ?>>File</option>
                        <option value="Textarea" <?php echo ($field->field_type === 'Textarea') ? 'selected' : ''; ?>>Textarea</option>
                        <option value="Radio" <?php echo ($field->field_type === 'Radio') ? 'selected' : ''; ?>>Radio-Buttons</option>
                        <option value="Checkbox" <?php echo ($field->field_type === 'Checkbox') ? 'selected' : ''; ?>>Checkbox</option>     
                    </select>

                    <?php if (in_array($field->field_type, array('Dropdown', 'Checkbox', 'Radio'))): ?>
                        <label class="form-label">Options:</label>
                        <div class="option-fields">
                        <?php foreach ($field->options as $option_index => $option_value): ?>
                            <div class="option-field">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="option_value[<?php echo $index; ?>][]" value="<?php echo $option_value; ?>" placeholder="Option Value">
                                    </div>
                                    <div class="col-md-2">
                                        <?php if ($option_index > 0): ?>
                                            <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-2 add-option">Add Option</button>
                        <div class="container mt-4 mb-4">
                        <label for="field_required_<?php echo $index; ?>" class="form-check-label">Required: </label>
                            <input type="checkbox" class="form-check-input" name="field_required[]" <?php echo ($field->field_required) ? 'checked' : ''; ?>>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Update Form</button>
        <?php echo form_close(); ?>
    </div>

    <script>
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
    </script>
</body>
</html>
