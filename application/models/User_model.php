<?php

defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_model
{
    public $database = 'College-DataBase';
    public $collection = 'College_register';
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongodb');
        $this->conn = $this->mongodb->getConn();
    }

    public function get_user_by_email($email)
    {
        try {
            //$collectionName = 'user_registration';
            $collection = 'College_register';
            $filter = ['email' => $email];
            $query = new MongoDB\Driver\Query($filter);

            $result = $this->conn->executeQuery($this->database . '.' . $collection, $query);

            foreach ($result as $user) {
                return $user; // Return the first matching user document
            }

            return null; // No user found
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while fetching user: ' . $ex->getMessage(), 500);
        }
    }

    public function register_user($name, $email, $password)
    {
        try {
            $user = array(
                'name' => $name,
                'email' => $email,
                'password' => $password
            );

            // Define the collection name for user registration
            $collectionName = 'College_register';

            $this->createCollectionIfNotExists($collectionName);

            $query = new MongoDB\Driver\BulkWrite();
            $query->insert($user);

            $result = $this->conn->executeBulkWrite($this->database . '.' . $collectionName, $query);

            if ($result == 1) {
                return true;
            }
            return false;
        } catch (MongoDB\Driver\Exception\RuntimeException $ex) {
            show_error('Error while saving users: ' . $ex->getMessage(), 500);
        }
    }

    public function is_email_taken($email)
    {
        $collectionName = 'user_registration';
        $filter = ['email' => $email];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->conn->executeQuery($this->database . '.' . $collectionName, $query);

        $count = 0;
        foreach ($cursor as $document) {
            $count++;
        }

        return $count > 0;
    }

    public function is_username_taken($email)
    {

        $filter = ['email' => $email];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->conn->executeQuery($this->database . '.' . $collection, $query);

        $count = 0;
        foreach ($cursor as $document) {
            $count++;
        }

        return $count > 0;
    }


    public function createCollectionIfNotExists($collectionName)
    {
        $command = new MongoDB\Driver\Command([
            'create' => $collectionName,
        ]);

        try {
            $this->conn->executeCommand($this->database, $command);
        } catch (MongoDB\Driver\Exception\CommandException $ex) {
            if ($ex->getCode() !== 48) {
                show_error('Error creating collection: ' . $ex->getMessage(), 500);
            }
        }
    }
}
