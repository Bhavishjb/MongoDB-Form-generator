<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forms_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        // Load the Forms_model
        $this->load->model('Forms_model');

        // Handle form submission
        if ($this->input->post()) {

            // Collect form data
            $clg_id = $this->session->userdata('user_id');
            $form_title = $this->input->post('form_title');
            $form_description = $this->input->post('form_description');
            $field_labels = $this->input->post('field_label');
            $field_types = $this->input->post('field_type');
            $option_values = $this->input->post('option_value');
            $required = $this->input->post('field_required');
            $size_length = $this->input->post('size_length');


            // Create an array to hold the form data
            $form_data = array(
                'clg_id' => $clg_id,
                'form_title' => $form_title,
                'form_description' => $form_description,
                'fields' => array(),
            );

            for ($i = 0; $i < count($field_labels); $i++) {
                if (!($size_length[$i])) {
                    $size_length[$i] = 255;
                }
            }

            for ($i = 0; $i < count($field_labels); $i++) {
                $field = array(
                    'field_label' => $field_labels[$i],
                    'field_type' => $field_types[$i],
                    'field_required' =>  $required[$i],
                    'size_length' => $size_length[$i],
                );

                if (in_array($field_types[$i], array('Dropdown', 'Checkbox', 'Radio'))) {
                    $field_options = array();
                    for ($j = 0; $j < count($option_values[$i]); $j++) {
                        $field_options[] = $option_values[$i][$j];
                    }
                    $field['options'] = $field_options;
                }
                $form_data['fields'][] = $field;
            }

            $insert_result = $this->Forms_model->create_form($form_data);

            if ($insert_result) {
                //var_dump($option_values);
                $clg_id = $this->session->userdata('user_id');
                redirect('display_form/' . urlencode($clg_id));
            } else {
                redirect('home');
            }
        }

        // Load the view
        $this->load->view('templates/header');
        $this->load->view('form_builder');
        $this->load->view('templates/footer');
    }

    public function view_forms()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $data['forms'] = $this->Forms_model->get_all_forms();

        $this->load->view('templates/header');
        $this->load->view('forms_view', $data); 
        $this->load->view('templates/footer');
    }
    public function display_form($clg_id)
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        // Retrieve form details from MongoDB based on $form_id
        $form_data = $this->Forms_model->get_forms_by_clg_id($clg_id);


        $data['form_data'] = $form_data; // Pass the data to the view

        // Load the display_form view with form data
        $this->load->view('templates/header');
        $this->load->view('display_form', $data);
        $this->load->view('templates/footer');
    }
    public function remove_form($form_id)
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
      
        // Call the model's method to delete the form by ID
        $deleted = $this->Forms_model->delete_form($form_id);

        if ($deleted) {
            // Form was successfully deleted, redirect to a  another action
            redirect('display_form/' . urlencode($this->session->userdata('user_id')));
        } else {

            // Handle deletion error
            show_error('Error while deleting the form', 500);
        }
    }
    public function edit_form($form_id)
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        // Retrieve form details from MongoDB based on $form_id
        $form_data = $this->Forms_model->get_form($form_id);

        if ($form_data) {
          
            // Load the edit_form view and pass form_data
            $data['form_data'] = $form_data;
            // Load the edit_form_view.php view with prepopulated data
            $this->load->view('templates/header');
            $this->load->view('edit_form_view', $data);

        } else {
            // Handle form not found error
            show_error('Form not found', 404);
        }
    }
    public function update_form($form_id)
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        // Retrieve form data from the submitted form
        $form_title = $this->input->post('form_title');
        $form_description = $this->input->post('form_description');
        $field_labels = $this->input->post('field_label');
        $field_types = $this->input->post('field_type');
        $required = $this->input->post('field_required');
        $size_length = $this->input->post('size_length');
        $option_values = $this->input->post('option_value'); // Added this line for options

        // Construct the updated form data array
        $updated_form_data = array(
            'form_title' => $form_title,
            'form_description' => $form_description,
            'fields' => array(),
        );

        for ($i = 0; $i < count($field_labels); $i++) {
            $field = array(
                'field_label' => $field_labels[$i],
                'field_type' => $field_types[$i],
                'field_required' => $required[$i],
                'size_length' => $size_length[$i],
            );

            // Handling options for specific field types
            if (in_array($field_types[$i], array('Dropdown', 'Checkbox', 'Radio'))) {
                $field_options = array();
                if (isset($option_values[$i])) {
                    foreach ($option_values[$i] as $option_value) {
                        if (!empty($option_value)) {
                            $field_options[] = $option_value;
                        }
                    }
                }
                $field['options'] = $field_options;
            }
            $updated_form_data['fields'][] = $field;
        }

        // update the form in the database using the Forms_model
        $update_result = $this->Forms_model->update_form($form_id, $updated_form_data);

        if ($update_result) {
            // Update successful, redirect back to the form list
            $clg_id = $this->session->userdata('user_id');
            redirect('FormController/display_form/' . urlencode($clg_id)); // Adjust the URL as needed
        } else {
            // Handle update failure
            show_error('Form update failed', 500);
        }
    }
    public function generate_form($form_id)
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        // Retrieve form details from MongoDB based on $form_id
        $form_data = $this->Forms_model->get_form($form_id);

        if ($form_data) {
            $data['form_data'] = $form_data; // Pass the form data to the view

            // Load the generate_form view with form data
            $this->load->view('templates/header');
            $this->load->view('generate_form', $data);
            $this->load->view('templates/footer');
        } else {
            // Handle form not found error
            show_error('Form not found', 404);
        }
    }
}
