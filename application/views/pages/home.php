<!DOCTYPE html>
<html>

<head>
  <title>Welcome to Dynamic Form Generator</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
  <style>
    /* Custom CSS for Introduction Section */
    .intro-section {
      background-color: #007bff;
      color: #fff;
      padding: 50px 0;
    }

    .intro-heading {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .intro-description {
      font-size: 18px;
    }

    /* Button Styling */
    .btn-create-form {
      background-color: #28a745;
      margin-right: 8px;
      color: #fff;
      font-size: 24px;
      padding: 20px 40px;
      border: none;
      margin-top: 20px;
    }

    .btn-form-list {
      background-color: orange;


      color: #fff;
      font-size: 24px;
      padding: 20px 80px;
      border: none;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid intro-section">
    <div class="container text-center">
      <h1 class="intro-heading">Welcome to Dynamic Form Generator!</h1>
      <p class="intro-description">
        Simplify form creation and data collection with our powerful tool. Design custom forms tailored to your needs and manage them effortlessly.
      </p>
      <div>
        <a href="<?php echo base_url('FormController/index'); ?>" class="btn btn-create-form">Create Your Form</a>
        <a href="<?php echo base_url(); ?>/FormController/display_form/<?php echo $this->session->userdata('user_id'); ?>" class="btn btn-form-list">Form Lists</a>
      </div>

    </div>
  </div>
</body>

</html>