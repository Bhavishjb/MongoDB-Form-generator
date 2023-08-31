<!DOCTYPE html>
<html>

<head>
  <title>Edit Form</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>
                        
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container">
              <h2 style="text-align:center;">Edit Form</h2>
              <form method="post" action="<?php echo base_url('FormController/update_form/' . $form_id); ?>">

                <div class="form-group">
                  <label for="form_title">Form Title</label>
                  <input type="text" class="form-control" id="form_title" name="form_title" value="<?php echo $form_title; ?>">
                </div>
                <div class="form-group">
                  <label for="form_description">Form Description</label>
                  <textarea class="form-control" id="form_description" name="form_description"><?php echo $form_description; ?></textarea>
                </div>
                <!-- Repeat this section for other form fields -->
                <?php foreach ($form_fields as $field) : ?>
                  <div class="form-group">
                    <label for="field_label">Field Label</label>
                    <input type="text" class="form-control" name="field_label[]" value="<?php echo $field->field_label; ?>">
                  </div>
                  <div class="form-group">
                    <label for="field_type">Field Type</label>
                    <select class="form-control" name="field_type[]">
                      <option value="Text" <?php echo ($field->field_type === 'Text') ? 'selected' : ''; ?>>Text</option>
                      <option value="Textarea" <?php echo ($field->field_type === 'Textarea') ? 'selected' : ''; ?>>Textarea</option>
                      <!-- Add options for other field types -->
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="field_required">Required</label>
                    <input type="checkbox" name="field_required[]" <?php echo ($field->field_required === 'on') ? 'checked' : ''; ?>>
                  </div>
                  <div class="form-group">
                    <label for="size_length">Size/Length</label>
                    <input type="number" class="form-control" name="size_length[]" value="<?php echo $field->size_length; ?>">
                  </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary">Update Form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>

  </div>
</body>

</html>