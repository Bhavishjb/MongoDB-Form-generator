<!DOCTYPE html>
<html>

<head>
    <title>User</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
</head>
<script>
    // Automatically close flash messages after 3 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s, visibility 0.5s';
            alert.style.opacity = '0';
            alert.style.visibility = 'hidden';
            alert.parentNode.removeChild(alert);
        });
    }, 3000); 
</script>
<style>
    .alert {
        transition: opacity 0.5s, visibility 0.5s;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand"  href="<?php echo base_url('/FormController/index'); ?>">USER</a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            

            <div class="navbar-collapse collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/FormController/index'); ?>">HOME
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>about">ABOUT</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto"> <!-- Moved navbar-right class to this ul -->
                    <?php if (!$this->session->userdata('user_id')) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('login'); ?>">LOGIN</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('register'); ?>">REGISTER</a></li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('user_id')) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('login/logout'); ?>">LOGOUT</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- flash messages -->
        <?php if ($this->session->flashdata('user_registered')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('user_loggedin')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('user_loggedout')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
        <?php endif; ?>
    </div>

    <!-- Make sure you have included Bootstrap JavaScript and jQuery libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.7.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="collapse"]').click(function() {
                $('.navbar-collapse').toggleClass('show');
            });
        });
    </script>

</body>

</html>