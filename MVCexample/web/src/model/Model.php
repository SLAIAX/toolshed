<?php
namespace agilman\a2\model;

use mysqli;

/**
 * Class Model
 * Drumm and Waddell
 * IDs: 17044923    16379344
 * @package agilman/a2
 */
class Model
{
    protected $db;
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
            throw new \mysqli_sql_exception();
        }

        //----------------------------------------------------------------------------
        // This is to make our life easier
        // Create your database and populate it with sample data
        $this->db->query("CREATE DATABASE IF NOT EXISTS " . Model::DB_NAME . ";");

        if (!$this->db->select_db(Model::DB_NAME)) {
            error_log("Mysql database not available!", 0);
            throw new \mysqli_sql_exception();
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
                throw new \mysqli_sql_exception();
            }
            $password = password_hash('Bobthebuilder1', PASSWORD_BCRYPT);
            if (!$this->db->query(
                "INSERT INTO `account` VALUES (NULL,'Bob', 'BobTheBuilder', 'bob@gmail.com', '$password');"
            )) {
                error_log("Failed creating sample data!", 0);
                throw new \mysqli_sql_exception();
            }

            $result = $this->db->query(
                "CREATE TABLE `products` ( `id`  INT(8) unsigned NOT NULL AUTO_INCREMENT , 
                       `sku` VARCHAR(256) NOT NULL ,
                       `name` VARCHAR(256) NOT NULL ,
                       `category` VARCHAR(256) NOT NULL ,
                       `cost` VARCHAR(256) NOT NULL ,
                       `stock_quantity` INT(8) NOT NULL ,
                        PRIMARY KEY (`id`));"
            );

            if (!$result) {
                // handle appropriately
                error_log("Failed creating table products", 0);
                throw new \mysqli_sql_exception();
            }


            if (!$this->db->query(
                "INSERT INTO `products` (`id`, `sku`, `name`, `category`, `cost`, `stock_quantity`) VALUES 
                                                        (NULL,'ham13', 'Square Hammer', 'Hammers', '$21.65', 10),
                                                        (NULL,'ham14', 'MC Hammer', 'Hammers', '$39.95', 4),
                                                        (NULL,'ham15', 'Claw Hammer', 'Hammers', '$3.00', 16),
                                                        (NULL,'ham16', 'Ball-peen Hammer', 'Hammers', '$21.62', 39),
                                                        (NULL,'spd13', 'Garden Shovel', 'Spades', '$5.70', 28),
                                                        (NULL,'spd14', 'Garden Spade', 'Spades', '$60.00', 14),
                                                        (NULL,'spd15', 'Snow Shovel', 'Spades', '$99.99', 57),
                                                        (NULL,'spd16', 'Poop Scoop', 'Spades', '$45.50', 19),
                                                        (NULL,'swd13', 'Philips Head', 'Screw Drivers', '$21.13', 160),
                                                        (NULL,'swd14', 'Flat Head', 'Screw Drivers', '$90.45', 174),
                                                        (NULL,'swd15', 'Alan Head', 'Screw Drivers', '$10.55', 73),
                                                        (NULL,'swd16', 'Torx Head', 'Screw Drivers', '$6.95', 56),
                                                        (NULL,'drl13', 'Twist Drill', 'Drills', '$399.95', 178),
                                                        (NULL,'drl14', 'Brad Point Drill', 'Drills', '$60.95', 78),
                                                        (NULL,'drl15', 'Auger Drill', 'Drills', '$100.50', 13),
                                                        (NULL,'drl16', 'Spade Drill', 'Drills', '$299.99', 45);")) {
                // handle appropriately
                error_log("Failed creating sample data for products!", 0);
                throw new \mysqli_sql_exception();
            }
        }
    }
}
