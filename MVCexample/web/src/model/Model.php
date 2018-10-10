<?php
namespace agilman\a2\model;

use mysqli;

/**
 * Class Model
 * Drumm and Waddell
 * IDs: 17044923    16379344
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class Model
{
    protected $db;

    // is this the best place for these constants?
    const DB_HOST = 'mysql';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'a3';

    public function __construct()
    {
        $this->db = new mysqli(
            Model::DB_HOST,
            Model::DB_USER,
            Model::DB_PASS
            //            Model::DB_NAME
        );

        if (!$this->db) {
            // can't connect to MYSQL???
            // handle it...
            // e.g. throw new someException($this->db->connect_error, $this->db->connect_errno);
        }

        //----------------------------------------------------------------------------
        // This is to make our life easier
        // Create your database and populate it with sample data
        $this->db->query("CREATE DATABASE IF NOT EXISTS " . Model::DB_NAME . ";");

        if (!$this->db->select_db(Model::DB_NAME)) {
            // somethings not right.. handle it
            error_log("Mysql database not available!", 0);
        }

        $result = $this->db->query("SHOW TABLES LIKE 'account';");

        if ($result->num_rows == 0) {
            // table doesn't exist
            // create it and populate with sample data

            $result = $this->db->query(
                "CREATE TABLE `account` ( `id`  INT(8) unsigned NOT NULL AUTO_INCREMENT , 
                       `name` VARCHAR(256) NOT NULL ,
                       `username` VARCHAR(256) NOT NULL ,
                       `email` VARCHAR(256) NOT NULL ,
                       `password` VARCHAR(256) NOT NULL ,
                        PRIMARY KEY (`id`));"
            );

            if (!$result) {
                // handle appropriately
                error_log("Failed creating table account", 0);
            }

            if (!$this->db->query(
                "INSERT INTO `account` VALUES (NULL,'Bob', 'BobTheBuilder', 'bob@gmail.com', 'Bobthebuilder1');"
            )) {
                // handle appropriately
                error_log("Failed creating sample data!", 0);
            }

            $result = $this->db->query(
                "CREATE TABLE `products` ( `id`  INT(8) unsigned NOT NULL AUTO_INCREMENT , 
                       `sku` VARCHAR(256) NOT NULL ,
                       `name` VARCHAR(256) NOT NULL ,
                       `category` VARCHAR(256) NOT NULL ,
                       `cost` VARCHAR(256) NOT NULL ,
                       `stock_quantity` INT(256) NOT NULL ,
                        PRIMARY KEY (`id`)) ;"
            );
            if (!$result) {
                // handle appropriately
                error_log("Failed creating table products", 0);
            }


            if (!$this->db->query(
                "INSERT INTO `products` VALUES (NULL,'ham13', 'Square Hammer', 'Hammers', '$39.95', 10);"
            )) {
                // handle appropriately
                error_log("Failed creating sample data!", 0);
            }
        }
        //----------------------------------------------------------------------------
    }
}
