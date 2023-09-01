<!DOCTYPE html>
<html>
<head>
  <title>Display Form</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container">
              <h2 style="text-align:center;">Form Details</h2>
              <?php foreach ($form_data as $form) : ?>
                <br /><br /><br />
                <h3 class="mb-4">Form Title: <?php echo $form->form_title; ?></h3>
                <h5 class="mb-4">Form Description: <?php echo $form->form_description; ?></h5>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Field Label</th>
                      <th scope="col">Field Type</th>
                      <th scope="col">Required</th>
                      <th scope="col">Size/Length</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($form->fields as $field) : ?>
                      <tr class="table-light">
                        <td><?php echo $field->field_label; ?></td>
                        <td><?php echo $field->field_type; ?></td>
                        <td><?php echo $field->field_required == 'on' ? 'Yes' : 'No'; ?></td>
                        <td><?php echo $field->size_length; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="container mb-4">
                  <a href="<?php echo base_url('FormController/edit_form/' . $form->_id); ?>" class="btn btn-info btn-lg ">Edit</a>
                  <a href="#" class="btn btn-danger btn-lg " onclick="confirmDelete('<?php echo $form->_id; ?>')">Remove</a>
                  <a href="<?php echo base_url('FormController/generate_form/' . $form->_id); ?>" class="btn btn-success btn-lg float-end">Generate Form</a>
                </div>
                <hr>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(formId) {
      if (confirm("Are you sure you want to delete this form?")) {
        window.location.href = "<?php echo base_url('FormController/remove_form/'); ?>" + formId;
      }
    }
  </script>
</body>
</html>