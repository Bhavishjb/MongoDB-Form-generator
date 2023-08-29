<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller {
    public function index() {
        // Handle form submission
        if ($this->input->post()) {
            $fieldLabels = $this->input->post('field_label');
            $fieldTypes = $this->input->post('field_type');
            $fieldOptions = $this->input->post('field_options');
    
            $formTemplate = array();
            foreach ($fieldLabels as $index => $label) {
                $field = array(
                    'label' => $label,
                    'type' => $fieldTypes[$index]
                );
    
                if (in_array($fieldTypes[$index], array('checkbox', 'radio', 'select'))) {
                    $field['options'] = explode(',', $fieldOptions[$index]);
                }
    
                $formTemplate[] = $field;
            }
    
            // Store $formTemplate in the MongoDB collection for form templates
            $this->load->model('Forms_model');
            $this->Forms_model->create_form(array('fields' => $formTemplate));
        }
    
        // Load the view
        $this->load->view('templates\header');
        $this->load->view('form_builder');
        $this->load->view('templates\footer');
    }
}
