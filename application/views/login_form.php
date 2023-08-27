<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <?php if ($this->session->flashdata('login_error')): ?>
                            <div id="login-error" class="alert alert-danger" role="alert">
                                <?= $this->session->flashdata('login_error') ?>
                            </div>
                        <?php endif; ?>

                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                        <script>
                            // Hide the login error message after 5 seconds (5000 milliseconds)
                            var loginError = document.getElementById('login-error');
                            if (loginError) {
                                setTimeout(function() {
                                    loginError.style.display = 'none';
                                }, 5000);
                            }
                        </script>

                        <?php echo form_open('login/login_user'); ?>

                        <div class="form-group mb-4">
                            <label for="username">Email:</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter College Email" value="<?php echo set_value('email'); ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary col-12 mt-2">Login</button>
                        </div>

                        <p class="text-center mt-3">Don't have an account? <a href="<?php echo base_url(); ?>register">Sign up here</a></p>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>