<!DOCTYPE html>
<html>

<head>
  <title>Edit Form</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container mt-4">
              <h1 style="text-align:center;">Edit Form Elements</h1>

              <?php echo form_open('FormController/update_form/' . $form_data->_id); ?>
              <div class="form-group mt-5">
                <label for="form_title">Form Title:</label>
                <input type="text" class="form-control mt-2" id="form_title" name="form_title" value="<?php echo $form_data->form_title; ?>">
              </div>
              <div class="form-group mt-4">
                <label for="form_description">Form Description:</label>
                <textarea class="form-control mt-2" id="form_description" name="form_description"><?php echo $form_data->form_description; ?></textarea>
              </div>

              <?php foreach ($form_data->fields as $index => $field) : ?>
                <div class="mt-4 mb-4" data-field-index="<?php echo $index; ?>">
                  <label for="field_label_<?php echo $index; ?>" class="form-label ">Field Label:</label>
                  <input type="text" class="form-control mb-4" name="field_label[]" value="<?php echo $field->field_label; ?>" required>

                  <label for="field_type_<?php echo $index; ?>" class="form-label">Field Type:</label>
                  <select class="form-select" name="field_type[]">
                    <option value="Textbox" <?php echo ($field->field_type === 'Textbox') ? 'selected' : ''; ?>>Textbox</option>
                    <option value="Dropdown" <?php echo ($field->field_type === 'Dropdown') ? 'selected' : ''; ?>>Dropdown</option>
                    <option value="Date" <?php echo ($field->field_type === 'Date') ? 'selected' : ''; ?>>Date</option>
                    <option value="Email" <?php echo ($field->field_type === 'Email') ? 'selected' : ''; ?>>Email</option>
                    <option value="File" <?php echo ($field->field_type === 'File') ? 'selected' : ''; ?>>File</option>
                    <option value="Textarea" <?php echo ($field->field_type === 'Textarea') ? 'selected' : ''; ?>>Textarea</option>
                    <option value="Radio" <?php echo ($field->field_type === 'Radio') ? 'selected' : ''; ?>>Radio-Buttons</option>
                    <option value="Checkbox" <?php echo ($field->field_type === 'Checkbox') ? 'selected' : ''; ?>>Checkbox</option>
                  </select>

                  <?php if (in_array($field->field_type, array('Dropdown', 'Checkbox', 'Radio'))) : ?>
                    <div class="option-fields">
                      <label class="form-label mt-3">Options:</label>
                      <?php foreach ($field->options as $option_index => $option_value) : ?>
                        <div class="option-field">
                          <div class="row">
                            <div class="col-md-5">
                              <input type="text" class="form-control" name="option_value[<?php echo $index; ?>][]" value="<?php echo $option_value; ?>" placeholder="Option Value">
                            </div>
                            <div class="col-md-2">
                              <?php if ($option_index > 0) : ?>
                                <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>

                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2 add-option">Add Option</button>
                  <?php else : ?>
                    <div class="option-fields" style="display: none;">
                      <label class="form-label mt-3">Options:</label>
                      <div class="option-field">
                        <div class="row">
                          <div class="col-md-5">
                            <input type="text" class="form-control" name="option_value[<?php echo $index; ?>][]" placeholder="Option Value">
                          </div>
                          <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-danger remove-option">Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2 add-option">Add Option</button>
                  <?php endif; ?>

                </div>
                <div class="size-length mt-2">
                  <label class="form-label mt-4">Size/Length:</label>
                  <input type="number" class="form-control" name="size_length[]" placeholder="Enter Size/Length" value="<?php echo($field->size_length); ?>">
                </div>

                <div class=" mt-4 mb-5">
                  <label for="field_required_<?php echo $index; ?>" class="form-check-label">Required: </label>
                  <input type="checkbox" class="form-check-input" name="field_required[]" <?php echo ($field->field_required) ? 'checked' : ''; ?>>
                </div>
              <?php endforeach; ?>

              <div class="d-grid gap-2"><button type="submit" class="btn btn-lg btn-success ">Update Form</button></div>

              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/edit-form-js.js"></script>
</body>
</html>