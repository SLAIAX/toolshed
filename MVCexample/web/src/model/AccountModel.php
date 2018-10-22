<?php
namespace agilman\a2\model;


/**
 * Class AccountModel
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class AccountModel extends Model
{

    private $id;
    private $name;
    private $username;
    private $email;
    private $password;

    /**
     * AccountModel constructor.
     * @param $name
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct($name, $username, $email, $password)
    {
        parent::__construct();
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        if($this->db == NULL){
            error_log("DB is NULL in constructor", 100);
        }
    }


    /**
     * @return int Account ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string Account Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name Account name
     *
     * @return $this AccountModel
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Loads account information from the database
     *
     * @param int $id Account ID
     *
     * @return $this AccountModel
     */
    public function load($id)
    {
        if (!$result = $this->db->query("SELECT * FROM `account` WHERE `id` = $id;")) {
            // throw new ...
        }

        $result = $result->fetch_assoc();
        $this->name = $result['name'];
        $this->id = $id;

        return $this;
    }

    /**
     * Saves account information to the database

     * @return $this AccountModel
     */
    public function save()
    {
        $name = $this->name ?? "NULL";
        $username = $this->username;
        $email = $this->email;
        $password = password_hash($this->password, PASSWORD_BCRYPT);
        // New account - Perform INSERT
        if($this->db == NULL){
            error_log("DB is NULL", 100);
        }
        if (!$result = $this->db->query("INSERT INTO `account` VALUES (NULL,'$name', '$username', '$email', '$password');")) {
           throw new \mysqli_sql_exception();
        }
        //$this->id = $this->db->insert_id;
    }

    /**
     * Deletes account from the database

     * @return $this AccountModel
     */
    public function delete()
    {
        if (!$result = $this->db->query("DELETE FROM `account` WHERE `account`.`id` = $this->id;")) {
            //throw new ...
        }

        return $this;
    }

    public function validateLogin(){
        if(!$result = $this->db->query("SELECT * FROM `account` WHERE `username` = '$this->username';")){
            return FALSE;   //Throw
        }
        $result = $result->fetch_assoc();
        if(!$result){
            return FALSE;
        }
        $result = $result['password'];
        if(password_verify($this->password, $result)){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    public function availableUserName(){
        if(!$result = $this->db->query("SELECT username FROM `account` WHERE `username` = '$this->username';")){
            return TRUE;        //Throw
        }
        $result = $result->fetch_assoc();
        if(!$result){
            return TRUE;
        }
        return FALSE;
    }
}
