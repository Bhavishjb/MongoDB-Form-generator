<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms_model extends CI_Model {

    
    public $collection = 'fields';
    public $database = 'College-DataBase';

    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongodb');
        $this->conn = $this->mongodb->getConn();
    }
    public function create_form($data)
    {
        try {
            $collection = 'fields';
            // Define the collection name for user registration
            $this->load->model('User_model');
            $this->User_model->createCollectionIfNotExists($collection);

            $query = new MongoDB\Driver\BulkWrite();
            $query->insert($data);

            $result = $this->conn->executeBulkWrite($this->database . '.' . $collection, $query);

            if ($result == 1) {
                return TRUE;
            }

            return FALSE;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while saving users: ' . $ex->getMessage(), 500);
        }
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
