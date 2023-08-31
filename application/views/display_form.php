<!-- display_form.php -->
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
                            <h3>Form Title: <?php echo $form_title; ?></h3>
                            <p>Form Description: <?php echo $form_description; ?></p>
                            <h3>Form Fields</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Field Label</th>
                                        <th>Field Type</th>
                                        <!-- Add other table headers as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($form_fields as $field) : ?>
                                        <tr>
                                            <td><?php echo $field['field_label']; ?></td>
                                            <td><?php echo $field['field_type']; ?></td>
                                            <!-- Add other table columns as needed -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url('form/edit_form/' . $form_id); ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
