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
                                <br/><br/><br/>
                                <h3>Form Title: <?php echo $form->form_title; ?></h3>
                                <p>Form Description: <?php echo $form->form_description; ?></p>
                                <h3>Form Fields</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Field Label</th>
                                            <th>Field Type</th>
                                            <th>Required</th>
                                            <th>Size/Length</th>
                                            <!-- Add other table headers as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($form->fields as $field) : ?>
                                            <tr>
                                                <td><?php echo $field->field_label; ?></td>
                                                <td><?php echo $field->field_type; ?></td>
                                                <td><?php echo $field->field_required == 'on' ? 'Yes' : 'No'; ?></td>
                                                <td><?php echo $field->size_length; ?></td>
                                                <!-- Add other table columns as needed -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo base_url('FormController/edit_form/' . $form->_id); ?>" class="btn btn-primary">Edit</a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
