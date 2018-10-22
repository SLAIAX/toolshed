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
            throw new \mysqli_sql_exception();
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
        if (!$result = $this->db->query("INSERT INTO `account` VALUES (NULL,'$name', '$username', '$email', '$password');")) {
           throw new \mysqli_sql_exception();
        }
    }

    public function validateLogin(){
        if(!$result = $this->db->query("SELECT * FROM `account` WHERE `username` = '$this->username';")){
            throw new \mysqli_sql_exception();
        }
        $result = $result->fetch_assoc();
        if(!$result){
            throw new \mysqli_sql_exception();
        }
        $result = $result['password'];
        if(password_verify($this->password, $result)){
            return TRUE;
        } else{
            throw new \Exception();
        }
    }

    public function availableUserName(){
        if(!$result = $this->db->query("SELECT username FROM `account` WHERE `username` = '$this->username';")){
            throw new \mysqli_sql_exception();
        }
        $result = $result->fetch_assoc();
        if(!$result){
            return TRUE;
        }
        return FALSE;
    }
}
