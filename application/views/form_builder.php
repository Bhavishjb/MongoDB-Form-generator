<!DOCTYPE html>
<html>

<head>
  <title>Form Generator</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
  <div class=" container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            <div class="container ">
              <h2 class="mb-5" style="text-align:center;">Create Your Form</h2>
              <h4 class="mb-5">
                <?php
                $user_id = $this->session->userdata('user_id');
                if ($user_id !== null) {
                    echo "College ID: " . $user_id;
                } else {
                    echo "College ID not set.";
                }
                ?>
              </h4>

              <form action="index" method="post" id="form-generator-form">
                <div class="mb-4">
                  <label for="form_title" class="form-label">Form Title:</label>
                  <input type="text" class="form-control" name="form_title" required>
                </div>

                <div class="mb-4">
                  <label for="form_description" class="form-label">Form Description:</label>
                  <textarea class="form-control" name="form_description"></textarea>
                </div>

                <h3>Form Fields</h3>

                <div class="form-group mt-4" id="form-fields-container">
                  <!-- Fields will be added here -->
                </div>

                <button type="button" class="btn btn-primary btn-lg me-4 mt-3 mb-4" id="add-field-button">Add Field</button>
                <button type="submit" class="btn btn-success btn-lg mt-3 mb-4">Save Form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/js/form-builder-js.js"></script>
</body>

</html>