<!DOCTYPE html>
<html>

<head>
  <title>Generated Form</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container mt-4">
              <h1 class="text-center"  style= "font-size:5rem;" > <?php echo $form_data->form_title; ?></h1>

              <h4 class="mb-4 mt-4">Form Description: <?php echo $form_data->form_description; ?></h4>
              <?php foreach ($form_data->fields as $field) : ?>

                <div class="form-group mt-4">
                  <label class="form-label"><?php echo $field->field_label; ?>:</label>
                  <?php
                  $field_name = $field->field_label;
                  $field_id = str_replace(' ', '_', strtolower($field_name));
                  $attributes = array(
                    'name' => $field_name,
                    'id' => $field_id,
                    'class' => 'form-control'
                  );

                  if ($field->field_required === 'on') {
                      $attributes['required'] = 'required';
                  }

                  if ($field->field_type === 'Email') {
                      $field_name = 'Email';
                      $field_id = str_replace(' ', '_', strtolower($field_name));
                      $attributes = array(
                          'name' => $field_name,
                          'id' => $field_id,
                          'class' => 'form-control'
                      );

                      if ($field->field_required === 'on') {
                          $attributes['required'] = 'required';
                      }
                      echo '<input type="email" ' . implode(' ', array_map(function ($key, $value) {
                          return $key . '="' . $value . '"';
                      }, array_keys($attributes), $attributes)) . '>';
                  } elseif ($field->field_type === 'Date') {
                      $field_name = 'Date';
                      $field_id = str_replace(' ', '_', strtolower($field_name));
                      $attributes = array(
                          'name' => $field_name,
                          'id' => $field_id,
                          'class' => 'form-control'
                      );

                      if ($field->field_required === 'on') {
                          $attributes['required'] = 'required';
                      }
                      echo '<input type="date" ' . implode(' ', array_map(function ($key, $value) {
                          return $key . '="' . $value . '"';
                      }, array_keys($attributes), $attributes)) . '>';
                  } elseif ($field->field_type === 'Textbox') {
                      $field_name = 'Text';
                      $field_id = str_replace(' ', '_', strtolower($field_name));
                      $attributes = array(
                        'name' => $field_name,
                        'id' => $field_id,
                        'class' => 'form-control'
                      );

                      if ($field->field_required === 'on') {
                          $attributes['required'] = 'required';
                      }
                      echo form_input($attributes);
                  } elseif ($field->field_type === 'Textarea') {
                      echo form_textarea($attributes);
                  } elseif ($field->field_type === 'File') {
                      echo form_upload($attributes);
                  } elseif ($field->field_type === 'Dropdown') {
                      $options = [];
                      foreach ($field->options as $option) {
                          $options[$option] = $option;
                      }
                      echo form_dropdown($field_name, $options, '', 'class="form-select"');
                  } elseif ($field->field_type === 'Checkbox') {
                      foreach ($field->options as $option) {
                          $checkbox_attributes = array(
                            'name' => $field_name . '[]',
                            'id' => $field_id . '_' . str_replace(' ', '_', strtolower($option)),
                            'value' => $option,
                            'class' => 'form-check-input'
                          );
                          echo '<div class="form-check">';
                          echo form_checkbox($checkbox_attributes);
                          echo '<label class="form-check-label" for="' . $field_id . '_' . str_replace(' ', '_', strtolower($option)) . '">' . $option . '</label>';
                          echo '</div>';
                      }
                  } elseif ($field->field_type === 'Radio') {
                      foreach ($field->options as $option) {
                          $radio_attributes = array(
                            'name' => $field_name,
                            'id' => $field_id . '_' . str_replace(' ', '_', strtolower($option)),
                            'value' => $option,
                            'class' => 'form-check-input'
                          );
                          echo '<div class="form-check">';
                          echo form_radio($radio_attributes);
                          echo '<label class="form-check-label" for="' . $field_id . '_' . str_replace(' ', '_', strtolower($option)) . '">' . $option . '</label>';
                          echo '</div>';
                      }
                  }
                  ?>
                </div>
              <?php endforeach; ?>

              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>