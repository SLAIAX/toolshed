<?php
namespace agilman\a2\model;


/**
 * Class AccountModel
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class ProductsModel extends Model
{
    public function searchProducts($str, $id){
        if(!$result = $this->db->query("SELECT * FROM `products` WHERE `id` = '$id' AND (`sku` LIKE '%$str%' OR `name` LIKE '%$str%' OR `category` LIKE '%$str%');")){
            //Throw
        }
        $result = $result->fetch_assoc();
        return $result;
    }
}


//$this->db->query("SELECT * FROM `products` WHERE `id` = '$id' AND `sku` LIKE '%$str%' OR `name` LIKE '%$str%' OR `category` LIKE '%$str%';"