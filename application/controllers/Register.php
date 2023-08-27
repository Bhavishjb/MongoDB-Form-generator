<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Load your registration form view here


        $this->load->view('templates/header');
        $this->load->view('register_form');
        $this->load->view('templates/footer');
    }

    public function register_user()
    {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        //$this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, reload the registration form with errors
            $this->load->view('templates/header');
            $this->load->view('register_form');
            $this->load->view('templates/footer');
        } else {
            // Validation successful, check for duplicate username and email
            //$username = $this->input->post('username');
            $email = $this->input->post('email');

            if ($this->User_model->is_email_taken($email)) {
                $this->session->set_flashdata('error_message', 'Email is already taken.');
                $this->load->view('templates/header');
                $this->load->view('register_form');
                $this->load->view('templates/footer');
            } else {
                $name = $this->input->post('name');
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                if ($this->User_model->register_user($name, $email, $password)) {
                    $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
                    redirect('login');
                } else {
                    redirect('about');
                }
            }
        }
    }
}
