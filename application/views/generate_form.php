<!DOCTYPE html>
<html>

<head>
  <title>Generate Form</title>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container">
              <h2 style="text-align:center;">Form</h2>
              <div>
                <?php if (isset($form_data->form_title)) : ?>
                  <h2><?php echo $form_data->form_title; ?></h2>
                <?php endif; ?>
                <?php if (isset($form_data->form_description)) : ?>
                  <p><?php echo $form_data->form_description; ?></p>
                <?php endif; ?>
                <?php foreach ($form_data->fields as $field) : ?>
                  <div>
                    <label for="<?php echo $field->field_label; ?>"><?php echo $field->field_label; ?></label>
                    <?php
                    $attributes = array(
                      'name' => $field->field_label,
                      'id' => $field->field_label,
                      'type' => $field->field_type,
                      'required' => $field->field_required == 'on' ? 'required' : '',
                      'size' => isset($field->size_length) ? $field->size_length : '',
                    );

                    if ($field->field_type === 'Dropdown') {
                      echo form_dropdown($field->field_label, $field->options, '', $attributes);
                    } elseif ($field->field_type === 'Checkbox') {
                      echo form_checkbox($attributes, '1');
                    } elseif ($field->field_type === 'Radio') {
                      echo form_radio($attributes, '1');
                    } else {
                      echo form_input($attributes);
                    }
                    ?>
                  </div>
                <?php endforeach; ?>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>