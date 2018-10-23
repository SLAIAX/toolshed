<?php
namespace agilman\a2\model;


/**
 * Class ProductsModel
 * @package agilman\a2\model
 */
class ProductsModel extends Model
{
    /**
     * @param $str
     * @param $id
     * @return mixed
     * Queries the database and sees if a product with a particular ID partially matches a string
     */
    public function searchProducts($str, $id)
    {
        if (!$result = $this->db->query("SELECT * FROM `products` WHERE `id` = '$id' AND (`sku` LIKE '%$str%' OR `name` LIKE '%$str%' OR `category` LIKE '%$str%');")) {
            throw new \mysqli_sql_exception();
        }
        $result = $result->fetch_assoc();
        return $result;
    }
}
