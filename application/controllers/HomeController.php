<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    
    $this->load->view('templates/header');
    $this->load->view('pages/home');
    $this->load->view('templates/footer');
  }
}
