<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forms_model extends CI_Model
{
    private $collection = 'fields';
    private $database = 'College-DataBase';
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
            $query = new MongoDB\Driver\BulkWrite();
            $query->insert($data);

            $result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

            if ($result) {
                return true;
            }

            return false;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while saving form: ' . $ex->getMessage(), 500);
        }
    }

    public function get_form($form_id)
    {
        try {
            $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($form_id)]);
            $result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);

            foreach ($result as $document) {
                return $document;
            }
            return null;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while fetching form: ' . $ex->getMessage(), 500);
        }
    }
    public function get_form_by_title($form_title)
    {
        try {
            $query = new MongoDB\Driver\Query(['form_title' => $form_title]); // Corrected syntax here
            $result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);

            foreach ($result as $document) {
                return $document;
            }
            return null;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while fetching form: ' . $ex->getMessage(), 500);
        }
    }

    public function update_form($form_id, $data)
    {
        try {
            $query = new MongoDB\Driver\BulkWrite();
            $query->update(
                ['_id' => new MongoDB\BSON\ObjectId($form_id)],
                ['$set' => $data]
            );

            $result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

            if ($result) {
                return true;
            }

            return false;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while updating form: ' . $ex->getMessage(), 500);
        }
    }

    public function delete_form($form_id)
    {
        try {
            $query = new MongoDB\Driver\BulkWrite();
            $query->delete(['_id' => new MongoDB\BSON\ObjectId($form_id)]);

            $result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

            if ($result) {
                return true;
            }

            return false;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while deleting form: ' . $ex->getMessage(), 500);
        }
    }

    public function get_all_forms()
    {
        try {
            $query = new MongoDB\Driver\Query([]);
            $result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);

            return $result->toArray();
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while fetching forms: ' . $ex->getMessage(), 500);
        }
    }
}
