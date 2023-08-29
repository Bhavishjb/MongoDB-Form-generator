<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submissions_model extends CI_Model {

private $collection = 'submissions';

public $database = 'College-DataBase';
private $conn;

public function __construct()
{
    parent::__construct();
    $this->load->library('mongodb');
    $this->conn = $this->mongodb->getConn();
}
public function create_submission($data) {
    return $this->mongo_db->insert($this->collection, $data);
}

public function get_submission($submission_id) {
    return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($submission_id))->getOne($this->collection);
}

public function get_submissions_by_form($form_id) {
    return $this->mongo_db->where('form_id', new MongoDB\BSON\ObjectId($form_id))->get($this->collection);
}
}
