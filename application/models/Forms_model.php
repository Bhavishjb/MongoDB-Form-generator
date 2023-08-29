<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms_model extends CI_Model {

    
    public $database = 'College-DataBase';
    public $collection = 'form';
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongodb');
        $this->conn = $this->mongodb->getConn();
    }
    public function create_form($data) {
        return $this->mongo_db->insert($this->collection, $data);
    }

    public function get_form($form_id) {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($form_id))->getOne($this->collection);
    }

    public function update_form($form_id, $data) {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($form_id))->set($data)->update($this->collection);
    }

    public function delete_form($form_id) {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($form_id))->delete($this->collection);
    }

    public function get_all_forms() {
        return $this->mongo_db->get($this->collection);
    }
    }
