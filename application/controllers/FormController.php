<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Forms_model'); // Load the Forms_model
        $this->load->model('Fields_model'); // Load the Fields_model
        $this->load->library('form_validation');
    }

    public function index() {
        // Load the Forms_model
        $this->load->model('Forms_model');
        
        // Handle form submission
        if ($this->input->post()) {
            // Collect form data
            $clg_id = $this->session->userdata('user_id'); // Correct way to get user_id from session
            $form_title = $this->input->post('form_title');
            $form_description = $this->input->post('form_description');
            $field_labels = $this->input->post('field_label'); // Assuming you're sending an array of field labels
            $field_types = $this->input->post('field_type'); // Assuming you're sending an array of field types
            $option_values = $this->input->post('option_value'); // Assuming you're sending an array of option values
            
            // Create an array to hold the form data
            $form_data = array(
                'clg_id' => $clg_id,
                'form_title' => $form_title,
                'form_description' => $form_description,
                'fields' => array(),
            );
    
            
            for ($i = 0; $i < count($field_labels); $i++) {
                $field = array(
                    'field_label' => $field_labels[$i],
                    'field_type' => $field_types[$i],
                );
    
                if (in_array($field_types[$i], array('Dropdown', 'Checkbox', 'Radio'))) {
                    $field['options'] = $option_values[$i];
                }
    
                $form_data['fields'][] = $field;
            }
    
            $insert_result = $this->Forms_model->create_form($form_data);
            
            if ($insert_result) {
                
                redirect('home');
            } else {
                
                redirect('home');
            }
        }
    
        // Load the view
        $this->load->view('templates/header');
        $this->load->view('form_builder');
        $this->load->view('templates/footer');
    }
    

    public function view_forms() {
        $data['forms'] = $this->Forms_model->get_all_forms();
        
        $this->load->view('templates/header');
        $this->load->view('forms_view', $data); // Create this view file
        $this->load->view('templates/footer');
    }
    
}
