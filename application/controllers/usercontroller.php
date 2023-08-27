<?php

defined('BASEPATH') or exit('No direct script access allowed');


class UserController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation'); // Load the form_validation library
	}

	function index()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$userCursor = $this->User_model->get_user_list();

		$users = $userCursor->toArray(); // Convert cursor to an array

		$data['users'] = $users;

		$this->load->view('templates/header');
		$this->load->view('users', $data);
		$this->load->view('templates/footer');
	}




	public function create()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');
			$this->form_validation->set_rules('gender', 'Gender', 'required'); // Add validation rule for gender
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|numeric'); // Add validation rule for mobile number

			if ($this->form_validation->run() !== FALSE) {
				$result = $this->User_model->create_user(
					$this->input->post('name'),
					$this->input->post('email'),
					$this->input->post('gender'),
					$this->input->post('mobile')
				);
				if ($result === TRUE) {
					redirect('usercontroller/index');
				} else {
					$data['error'] = 'Error occurred during saving data';
					$this->load->view('templates/header');
					$this->load->view('user_create', $data);
					$this->load->view('templates/footer');
				}
			} else {
				$data['error'] = 'Error occurred during saving data: all fields are required';
				$this->load->view('templates/header');
				$this->load->view('user_create', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('user_create');
			$this->load->view('templates/footer');
		}
	}

	public function update($_id)
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|numeric');

			if ($this->form_validation->run() !== FALSE) {
				$result = $this->User_model->update_user(
					$_id,
					$this->input->post('name'),
					$this->input->post('email'),
					$this->input->post('gender'), // Add gender
					$this->input->post('mobile') // Add mobile
				);

				if ($result === TRUE) {
					redirect('usercontroller/index');
				} else {
					$data['error'] = 'Error occurred during updating data';
					$this->load->view('templates/header');
					$this->load->view('user_update', $data);
					$this->load->view('templates/footer');
				}
			} else {
				$data['error'] = 'Error occurred during saving data: all fields are mandatory';
				$this->load->view('templates/header');
				$this->load->view('user_update', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$data['user'] = $this->User_model->get_user($_id);
			$this->load->view('templates/header');
			$this->load->view('user_update', $data);
			$this->load->view('templates/footer');
		}
	}

	public function delete($_id)
	{
		if ($_id) {
			$this->User_model->delete_user($_id);
		}
		redirect('usercontroller/index');
	}
}
