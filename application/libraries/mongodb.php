<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
* Author: https://roytuts.com
*/
#[\AllowDynamicProperties]
class MongoDB
{
    private $conn;

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->config('mongodb');

        $host = $this->ci->config->item('host');
        $port = $this->ci->config->item('port');
        $username = $this->ci->config->item('username');
        $password = $this->ci->config->item('password');
        $authenticate = $this->ci->config->item('authenticate');

        try {
            if($authenticate === true) {
                $this->ci->conn = new MongoDB\Driver\Manager('mongodb://' . $username . ':' . $password . '@' . $host. ':' . $port);
            } else {
                $this->ci->conn = new MongoDB\Driver\Manager('mongodb://' . $host. ':' . $port);
            }
        } catch(MongoDB\Driver\Exception\MongoConnectionException $ex) {
            show_error('Couldn\'t connect to mongodb: ' . $ex->getMessage(), 500);
        }
    }

    public function getConn()
    {
        return $this->ci->conn;
    }

}
