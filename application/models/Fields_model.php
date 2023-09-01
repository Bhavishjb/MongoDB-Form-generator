<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fields_model extends CI_Model
{
    private $collection = 'fields';
    public $database = 'College-DataBase';
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongodb');
        $this->conn = $this->mongodb->getConn();
    }
    public function create_field($data)
    {
        return $this->mongo_db->insert($this->collection, $data);
    }

    public function get_field($field_id)
    {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($field_id))->getOne($this->collection);
    }

    public function update_field($field_id, $data)
    {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($field_id))->set($data)->update($this->collection);
    }

    public function delete_field($field_id)
    {
        return $this->mongo_db->where('_id', new MongoDB\BSON\ObjectId($field_id))->delete($this->collection);
    }
    public function get_all_fields()
    {
        return $this->mongo_db->get($this->collection);
    }
}
