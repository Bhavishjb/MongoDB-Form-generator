<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Enter College Details</h2>

                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <?php echo form_open('register/register_user'); ?>
                        <?php
                        if ($this->session->flashdata('error_message')) {
                            echo '<div id="flash-message" class="alert alert-danger" role="alert">' . $this->session->flashdata('error_message') . '</div>';
                        }
                        ?>
                        <script>
                            // Automatically hide the flash message after 5 seconds
                            setTimeout(function() {
                                var flashMessage = document.getElementById('flash-message');
                                if (flashMessage) {
                                    flashMessage.style.display = 'none';
                                }
                            }, 5000);
                        </script>

                        <div class="form-group mb-4">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter College Name" value="<?php echo set_value('name'); ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter College Email" value="<?php echo set_value('email'); ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg col-12 mt-2">Register</button>
                        </div>

                        <p class="text-center mt-3">Already have an account? <a href="<?php echo base_url(); ?>login">Login here</a></p>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>